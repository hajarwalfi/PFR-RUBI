<?php


namespace App\Services;

use App\Models\Donation;
use App\Repositories\Interfaces\DonationRepositoryInterface;
use App\Repositories\Interfaces\SerologyRepositoryInterface;
use App\Repositories\Interfaces\ObservationRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class DonationService
{
    protected DonationRepositoryInterface $donationRepository;
    protected SerologyRepositoryInterface $serologyRepository;
    protected ObservationRepositoryInterface $observationRepository;

    public function __construct(
        DonationRepositoryInterface    $donationRepository,
        SerologyRepositoryInterface    $serologyRepository,
        ObservationRepositoryInterface $observationRepository
    )
    {
        $this->donationRepository = $donationRepository;
        $this->serologyRepository = $serologyRepository;
        $this->observationRepository = $observationRepository;
    }

    public function getAllDonations(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->donationRepository->getAllDonations($filters, $perPage);
    }

    public function getDonationById(int $id): ?Donation
    {
        return $this->donationRepository->getDonationWithRelations($id, ['user', 'serology', 'observations']);
    }

    public function getDonationsByUserId(int $userId): Collection
    {
        return $this->donationRepository->getDonationsByUserId($userId);
    }

    public function createDonation(array $data): Donation
    {
        // Générer un identifiant unique pour le don
        if (!isset($data['identifier'])) {
            $year = date('Y');
            $count = Donation::whereYear('created_at', $year)->count() + 1;
            $data['identifier'] = 'DON-' . $year . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);
        }

        $donation = $this->donationRepository->createDonation($data);

        // Créer la sérologie si les données sont fournies
        if (isset($data['serology'])) {
            $serologyData = $data['serology'];
            $serologyData['donation_id'] = $donation->id;

            // Déterminer le résultat global de la sérologie
            if (!isset($serologyData['result'])) {
                $serologyData['result'] = $this->determineSerologyResult($serologyData);
            }

            $this->serologyRepository->createSerology($serologyData);
        }

        // Créer les observations si les données sont fournies
        if (isset($data['observations']) && is_array($data['observations'])) {
            foreach ($data['observations'] as $observationData) {
                $observationData['donation_id'] = $donation->id;
                $this->observationRepository->createObservation($observationData);
            }
        }

        return $donation;
    }

    public function updateDonation(int $id, array $data): bool
    {
        $result = $this->donationRepository->updateDonation($id, $data);

        // Mettre à jour la sérologie si les données sont fournies
        if (isset($data['serology'])) {
            $serologyData = $data['serology'];
            $serology = $this->serologyRepository->getSerologyByDonationId($id);

            if ($serology) {
                // Déterminer le résultat global de la sérologie
                if (!isset($serologyData['result'])) {
                    $serologyData['result'] = $this->determineSerologyResult($serologyData);
                }

                $this->serologyRepository->updateSerology($serology->id, $serologyData);
            } else {
                $serologyData['donation_id'] = $id;

                // Déterminer le résultat global de la sérologie
                if (!isset($serologyData['result'])) {
                    $serologyData['result'] = $this->determineSerologyResult($serologyData);
                }

                $this->serologyRepository->createSerology($serologyData);
            }
        }

        // Gérer les observations
        if (isset($data['observations']) && is_array($data['observations'])) {
            // Supprimer les observations existantes
            $existingObservations = $this->observationRepository->getObservationsByDonationId($id);
            foreach ($existingObservations as $observation) {
                $this->observationRepository->deleteObservation($observation->id);
            }

            // Créer les nouvelles observations
            foreach ($data['observations'] as $observationData) {
                $observationData['donation_id'] = $id;
                $this->observationRepository->createObservation($observationData);
            }
        }

        return $result;
    }

    public function deleteDonation(int $id): bool
    {
        return $this->donationRepository->deleteDonation($id);
    }

    public function getLatestDonations(int $limit = 5): Collection
    {
        return $this->donationRepository->getLatestDonations($limit);
    }

    /**
     * Détermine le résultat global de la sérologie en fonction des tests individuels
     */
    private function determineSerologyResult(array $serologyData): string
    {
        // Si l'un des tests est positif, le résultat global est positif
        if (
            (isset($serologyData['tpha']) && $serologyData['tpha'] === 'positive') ||
            (isset($serologyData['hb']) && $serologyData['hb'] === 'positive') ||
            (isset($serologyData['hc']) && $serologyData['hc'] === 'positive') ||
            (isset($serologyData['vih']) && $serologyData['vih'] === 'positive')
        ) {
            return 'positive';
        }

        // Si tous les tests sont négatifs, le résultat global est négatif
        if (
            (isset($serologyData['tpha']) && $serologyData['tpha'] === 'negative') &&
            (isset($serologyData['hb']) && $serologyData['hb'] === 'negative') &&
            (isset($serologyData['hc']) && $serologyData['hc'] === 'negative') &&
            (isset($serologyData['vih']) && $serologyData['vih'] === 'negative')
        ) {
            return 'negative';
        }

        // Si certains tests sont manquants, le résultat est en attente
        return 'pending';
    }

    /**
     * Vérifie si un don est éligible pour être utilisé
     */
    public function isDonationEligible(Donation $donation): bool
    {
        // Un don est éligible si sa sérologie est négative
        if ($donation->serology && $donation->serology->result === 'negative') {
            return true;
        }

        return false;
    }
}
