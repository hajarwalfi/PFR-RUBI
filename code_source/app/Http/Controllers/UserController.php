<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserService $userService;

    /**
     * Constructeur avec injection de dépendance du UserService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
//        $this->middleware('admin');
    }

    /**
     * Affiche la liste des utilisateurs
     */
    public function index(Request $request)
    {
        // Récupérer les filtres de la requête
        $filters = [
            'search' => $request->input('search'),
            'eligibility' => $request->input('eligibility'),
            'per_page' => $request->input('per_page', 10)
        ];

        // Utiliser le service pour récupérer les données
        $users = $this->userService->getAllUsers($filters);
        $statistics = $this->userService->getUsersStatistics();

        // Passer le service à la vue pour utiliser ses méthodes
        return view('Admin.Users.index', [
            'users' => $users,
            'statistics' => $statistics,
            'request' => $request,
            'userService' => $this->userService // Important pour utiliser les méthodes du service dans la vue
        ]);
    }

    /**
     * Affiche les détails d'un utilisateur
     */
    public function show($id)
    {
        // Utiliser le service pour récupérer l'utilisateur
        $user = $this->userService->getUserById($id);

        // Vérifier si l'utilisateur existe
        if (!$user) {
            return redirect()->route('Admin.Users.index')
                ->with('error', 'Utilisateur non trouvé');
        }

        // Passer le service à la vue
        return view('Admin.Users.show', [
            'user' => $user,
            'userService' => $this->userService
        ]);
    }

    /**
     * Supprime un utilisateur
     */
    public function destroy($id)
    {
        // Utiliser le service pour supprimer l'utilisateur
        $result = $this->userService->deleteUser($id);

        // Rediriger avec un message de succès ou d'erreur
        if ($result) {
            return redirect()->route('Admin.Users.index')
                ->with('success', 'Utilisateur supprimé avec succès');
        } else {
            return redirect()->route('Admin.Users.index')
                ->with('error', 'Erreur lors de la suppression de l\'utilisateur');
        }
    }

    /**
     * Affiche le formulaire pour créer un nouvel utilisateur
     */
    public function create()
    {
        return view('Admin.Users.create');
    }

    /**
     * Enregistre un nouvel utilisateur
     */
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'phone' => 'nullable|string',
            'cni' => 'nullable|string|unique:users,cni',
            'birth_date' => 'nullable|date',
            'blood_group' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'gender' => 'nullable|in:male,female',
        ]);

        // Utiliser le service pour créer l'utilisateur
        $user = $this->userService->createUser($validated);

        return redirect()->route('Admin.Users.index')
            ->with('success', 'Utilisateur créé avec succès');
    }

    /**
     * Affiche le formulaire pour modifier un utilisateur
     */
    public function edit($id)
    {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return redirect()->route('Admin.Users.index')
                ->with('error', 'Utilisateur non trouvé');
        }

        return view('Admin.Users.edit', compact('user'));
    }

    /**
     * Met à jour un utilisateur
     */
    public function update(Request $request, $id)
    {
        // Valider les données du formulaire
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'nullable|string',
            'cni' => 'nullable|string|unique:users,cni,'.$id,
            'birth_date' => 'nullable|date',
            'blood_group' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'gender' => 'nullable|in:male,female',
        ]);

        // Utiliser le service pour mettre à jour l'utilisateur
        $result = $this->userService->updateUser($id, $validated);

        if ($result) {
            return redirect()->route('Admin.Users.index')
                ->with('success', 'Utilisateur mis à jour avec succès');
        } else {
            return redirect()->route('Admin.Users.edit', $id)
                ->with('error', 'Erreur lors de la mise à jour de l\'utilisateur');
        }
    }
}
