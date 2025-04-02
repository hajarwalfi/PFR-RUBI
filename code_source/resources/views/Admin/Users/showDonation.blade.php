@extends('Admin.layouts.aside')
@section('title', 'RUBI Admin - Détails de don')

@section('content')
    <main class="flex-1">

        <!-- Navigation -->
        <div class="p-4 flex justify-between items-center border-b border-gray-200">
            <div class="flex items-center space-x-2 text-xs">
                <a href="{{ route('Users.show', $donation->user_id) }}" class="inline-flex items-center p-2 rounded-md hover:bg-gray-100">
                    <i class="fas fa-arrow-left h-2 w-4"></i>
                </a>
                <div class="flex items-center text-gray-500">
                    <a href="{{ route('Users.index') }}" class="hover:text-black hover:underline">Donneurs</a>
                    <span class="mx-2">&gt;</span>
                    <a href="{{ route('Users.show', $donation->user_id) }}" class="hover:text-black hover:underline">{{ $donation->user->first_name }} {{ $donation->user->last_name }}</a>
                    <span class="mx-2">&gt;</span>
                    <a href="{{ route('Donations.show', $donation->id) }}" class="hover:text-black hover:underline">Détails du don</a>
                </div>
            </div>

            <a href="{{ route('Donations.edit', $donation->id) }}" class="bg-black text-white px-4 py-2 rounded-md flex items-center space-x-2">
                <i class="fas fa-edit h-4 w-4"></i>
                <span>Modifier</span>
            </a>
        </div>

        <!-- Informations du don -->
        <section class="p-6">
            <!-- ID et date -->
            <section class="mb-6">
                <h2 class="text-2xl font-bold mb-1">{{ $donation->identifier }}</h2>
                <div class="flex items-center mx-0.5">
                    <i class="far fa-calendar h-3 w-4 text-gray-500 text-xs mr-1"></i>
                    <span class="text-gray-600 text-xs">{{ $donation->date->format('d/m/Y') }}</span>
                </div>
            </section>

            <section class="grid grid-cols-12 gap-6">

                <div class="col-span-7 flex flex-col gap-6">
                    <!-- Détails du don -->
                    <div class="border border-gray-200 rounded-lg overflow-hidden">

                        <!-- Titre de la section -->
                        <div class="p-4 border-b border-gray-200">
                            <h3 class="font-bold">Détails du don</h3>
                            <p class="text-sm text-gray-500">Informations complètes sur le don effectué</p>
                        </div>

                        <!-- Date du don -->
                        <div class="p-4 border-b border-gray-200 flex">
                            <div class="w-1/2 flex items-start ">
                                <i class="far fa-calendar text-xs h-1 w-4 text-gray-400 mr-2 mt-1"></i>
                                <div>
                                    <p class="text-gray-600 text-sm">Date du don</p>
                                    <p class="font-medium">{{ $donation->date->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <div class="w-1/2 flex items-start">
                                <i class="fas fa-tint h-1 text-xs w-4 text-gray-400 mr-2 mt-1"></i>
                                <div>
                                    <p class="text-gray-600 text-sm">Quantité prélevée</p>
                                    <p class="font-medium">{{ $donation->quantity ?? 'N/A' }} ml</p>
                                </div>
                            </div>
                        </div>

                        <!-- Lieu et opérateur -->
                        <div class="p-4 flex">
                            <div class="w-1/2 flex items-start">
                                <i class="fas text-xs fa-map-marker-alt h-4 w-4 text-gray-400 mr-2 mt-1"></i>
                                <div>
                                    <p class="text-gray-600 text-sm">Lieu du don</p>
                                    <p class="font-medium">{{ $donation->location ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="w-1/2 flex items-start">
                                <i class="fas text-xs fa-user h-4 w-4 text-gray-400 mr-2 mt-1"></i>
                                <div>
                                    <p class="text-gray-600 text-sm">Opérateur</p>
                                    <p class="font-medium">{{ $donation->operator ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Résultats de sérologie -->
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <div class="p-4 border-b border-gray-200">
                            <h3 class="font-bold">Résultats de sérologie</h3>
                            <p class="text-sm text-gray-500">Informations complètes sur le résultat de sérologie</p>
                        </div>
                        <div class="p-4">
                            <div class="grid grid-cols-2 gap-4">
                                <!-- TPHA -->
                                <div class="border border-gray-200 rounded-lg p-3">
                                    <div class="font-medium mb-2">TPHA</div>
                                    @if($donation->serology)
                                        <div class="flex items-center {{ $donation->serology->tpha === 'positive' ? 'text-red-600' : 'text-green-600' }}">
                                            @if($donation->serology->tpha === 'positive')
                                                <i class="fas fa-times-circle h-4 w-4 mr-1"></i>
                                            @elseif($donation->serology->tpha === 'negative')
                                                <i class="fas fa-check-circle h-4 w-4 mr-1"></i>
                                            @else
                                                <i class="fas fa-clock h-4 w-4 mr-1"></i>
                                            @endif
                                            <span>{{ ucfirst($donation->serology->tpha ?? 'En attente') }}</span>
                                        </div>
                                    @else
                                        <div class="flex items-center text-gray-500">
                                            <i class="fas fa-clock h-4 w-4 mr-1"></i>
                                            <span>En attente</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- HB -->
                                <div class="border border-gray-200 rounded-lg p-3">
                                    <div class="font-medium mb-2">HB</div>
                                    @if($donation->serology)
                                        <div class="flex items-center {{ $donation->serology->hb === 'positive' ? 'text-red-600' : 'text-green-600' }}">
                                            @if($donation->serology->hb === 'positive')
                                                <i class="fas fa-times-circle h-4 w-4 mr-1"></i>
                                            @elseif($donation->serology->hb === 'negative')
                                                <i class="fas fa-check-circle h-4 w-4 mr-1"></i>
                                            @else
                                                <i class="fas fa-clock h-4 w-4 mr-1"></i>
                                            @endif
                                            <span>{{ ucfirst($donation->serology->hb ?? 'En attente') }}</span>
                                        </div>
                                    @else
                                        <div class="flex items-center text-gray-500">
                                            <i class="fas fa-clock h-4 w-4 mr-1"></i>
                                            <span>En attente</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- HC -->
                                <div class="border border-gray-200 rounded-lg p-3">
                                    <div class="font-medium mb-2">HC</div>
                                    @if($donation->serology)
                                        <div class="flex items-center {{ $donation->serology->hc === 'positive' ? 'text-red-600' : 'text-green-600' }}">
                                            @if($donation->serology->hc === 'positive')
                                                <i class="fas fa-times-circle h-4 w-4 mr-1"></i>
                                            @elseif($donation->serology->hc === 'negative')
                                                <i class="fas fa-check-circle h-4 w-4 mr-1"></i>
                                            @else
                                                <i class="fas fa-clock h-4 w-4 mr-1"></i>
                                            @endif
                                            <span>{{ ucfirst($donation->serology->hc ?? 'En attente') }}</span>
                                        </div>
                                    @else
                                        <div class="flex items-center text-gray-500">
                                            <i class="fas fa-clock h-4 w-4 mr-1"></i>
                                            <span>En attente</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- VIH -->
                                <div class="border border-gray-200 rounded-lg p-3">
                                    <div class="font-medium mb-2">VIH</div>
                                    @if($donation->serology)
                                        <div class="flex items-center {{ $donation->serology->vih === 'positive' ? 'text-red-600' : 'text-green-600' }}">
                                            @if($donation->serology->vih === 'positive')
                                                <i class="fas fa-times-circle h-4 w-4 mr-1"></i>
                                            @elseif($donation->serology->vih === 'negative')
                                                <i class="fas fa-check-circle h-4 w-4 mr-1"></i>
                                            @else
                                                <i class="fas fa-clock h-4 w-4 mr-1"></i>
                                            @endif
                                            <span>{{ ucfirst($donation->serology->vih ?? 'En attente') }}</span>
                                        </div>
                                    @else
                                        <div class="flex items-center text-gray-500">
                                            <i class="fas fa-clock h-4 w-4 mr-1"></i>
                                            <span>En attente</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-5 border border-gray-200 rounded-lg overflow-auto">
                    <div class="p-4 border-b border-gray-200 ">
                        <h3 class="font-bold">Observations</h3>
                    </div>
                    <div class="p-4   h-120 overflow-auto">
                        <form action="{{ route('Observations.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="donation_id" value="{{ $donation->id }}">
                            <textarea
                                name="comment"
                                class="w-full h-32 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-gray-400 resize-none"
                                placeholder="Ajouter une observation sur le don effectué..."
                            ></textarea>
                            <div class="mt-3 flex justify-end">
                                <button type="submit" class="bg-black text-white px-4 py-2 rounded-md flex items-center text-sm">
                                    <i class="fas fa-plus h-4 w-4 mr-1"></i>
                                    Ajouter
                                </button>
                            </div>
                        </form>

                        @if($donation->observations && $donation->observations->count() > 0)
                            @foreach($donation->observations->sortByDesc('created_at') as $observation)
                                <div class="border mt-4 border-gray-200 rounded-lg p-3 text-sm">
                                    <div class="flex justify-between items-start mb-2">
                                        <span class="text-gray-500">{{ $observation->created_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                    <p>{{ $observation->comment }}</p>
                                </div>
                            @endforeach
                        @else
                            <div class="border mt-6 border-gray-200 rounded-lg p-3 text-sm text-gray-500">
                                Aucune observation pour ce don
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        </section>
    </main>
@endsection
