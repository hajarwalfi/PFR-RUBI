@extends('User.layouts.aside')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Mes Donations</h2>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if($donations->isEmpty())
                            <div class="alert alert-info">
                                Vous n'avez pas encore effectué de donation.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Identifiant</th>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Lieu</th>
                                        <th>Quantité</th>
                                        <th>Résultat Sérologie</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($donations as $donation)
                                        <tr>
                                            <td>{{ $donation->identifier }}</td>
                                            <td>{{ $donation->date->format('d/m/Y') }}</td>
                                            <td>{{ $donation->type }}</td>
                                            <td>{{ $donation->location }}</td>
                                            <td>{{ $donation->quantity }}</td>
                                            <td>
                                                @if($donation->serology)
                                                    @if($donation->serology->result == 'positive')
                                                        <span class="badge bg-danger">Positif</span>
                                                    @elseif($donation->serology->result == 'negative')
                                                        <span class="badge bg-success">Négatif</span>
                                                    @else
                                                        <span class="badge bg-warning">En attente</span>
                                                    @endif
                                                @else
                                                    <span class="badge bg-secondary">Non disponible</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-primary">
                                                    Détails
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
