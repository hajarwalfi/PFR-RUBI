@extends('Admin.layouts.aside')
@section('title', 'RUBI Admin - Modifier un don')

@section('content')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <!-- Breadcrumb -->
        <div class="flex items-center text-sm text-gray-600 mb-6">
            <a href="{{ route('Donations.index') }}" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <a href="{{ route('Users.index') }}" class="hover:underline">Donneurs</a>
            <span class="mx-2">></span>
            <a href="{{ route('Users.show', $donation->user_id) }}" class="hover:underline">Dossier Médical</a>
            <span class="mx-2">></span>
            <span class="font-medium">Détails du don</span>
        </div>

        <!-- Page Title -->
        <h1 class="text-2xl font-bold mb-1">Modifier le don {{ $donation->donation_number }}</h1>
        <p class="text-sm text-gray-600 mb-6">Modifier les informations du don en sang</p>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <form action="{{ route('Donations.update', $donation->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Donation Information Section -->
            <div class="bg-white rounded-md border border-gray-200 p-6 mb-6">
                <h2 class="text-lg font-semibold mb-4">Informations du don</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Date du don -->
                    <div>
                        <label for="donation_date" class="block text-sm font-medium text-gray-700 mb-1">Date du don</label>
                        <input type="date" id="donation_date" name="donation_date" value="{{ old('donation_date', $donation->donation_date ? date('Y-m-d', strtotime($donation->donation_date)) : '') }}" class="w-full px-3 py-2 border @error('donation_date') border-red-500 @else border-gray-300 @enderror rounded-md">
                        @error('donation_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Type du don -->
                    <div>
                        <label for="donation_type" class="block text-sm font-medium text-gray-700 mb-1">Type du don</label>
                        <select id="donation_type" name="donation_type" class="w-full px-3 py-2 border @error('donation_type') border-red-500 @else border-gray-300 @enderror rounded-md">
                            <option value="Volontaire" {{ old('donation_type', $donation->donation_type) == 'Volontaire' ? 'selected' : '' }}>Volontaire</option>
                            <option value="Familial" {{ old('donation_type', $donation->donation_type) == 'Familial' ? 'selected' : '' }}>Familial</option>
                            <option value="Rémunéré" {{ old('donation_type', $donation->donation_type) == 'Rémunéré' ? 'selected' : '' }}>Rémunéré</option>
                        </select>
                        @error('donation_type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lieu du don -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Lieu du don</label>
                        <input type="text" id="location" name="location" value="{{ old('location', $donation->location) }}" placeholder="Centre de transfusion, hôpital, etc." class="w-full px-3 py-2 border @error('location') border-red-500 @else border-gray-300 @enderror rounded-md">
                        @error('location')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Quantité prélevée -->
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantité prélevée (ml)</label>
                        <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $donation->quantity) }}" class="w-full px-3 py-2 border @error('quantity') border-red-500 @else border-gray-300 @enderror rounded-md">
                        @error('quantity')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Opérateur -->
                    <div>
                        <label for="operator" class="block text-sm font-medium text-gray-700 mb-1">Opérateur</label>
                        <input type="text" id="operator" name="operator" value="{{ old('operator', $donation->operator) }}" placeholder="Nom du médecin ou infirmier..." class="w-full px-3 py-2 border @error('operator') border-red-500 @else border-gray-300 @enderror rounded-md">
                        @error('operator')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-between mt-6">
                    <a href="{{ route('Donations.show', $donation->id) }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium">Annuler</a>
                    <button type="submit" name="update_donation" class="px-4 py-2 bg-black text-white rounded-md text-sm font-medium flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        Sauvegarder
                    </button>
                </div>
            </div>
        </form>

        <form action="{{ route('Serology.update', $donation->serology->id ?? 0) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="donation_id" value="{{ $donation->id }}">

            <!-- Serology Information Section -->
            <div class="bg-white rounded-md border border-gray-200 p-6">
                <h2 class="text-lg font-semibold mb-4">Informations de sérologie</h2>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <!-- TPHA -->
                    <div>
                        <label for="tpha" class="block text-sm font-medium text-gray-700 mb-1">TPHA</label>
                        <div class="relative">
                            <select id="tpha" name="tpha" class="w-full px-3 py-2 border @error('tpha') border-red-500 @else border-gray-300 @enderror rounded-md appearance-none pr-10">
                                <option value="Négatif" {{ old('tpha', $donation->serology->tpha ?? '') == 'Négatif' ? 'selected' : '' }}>Négatif</option>
                                <option value="Positif" {{ old('tpha', $donation->serology->tpha ?? '') == 'Positif' ? 'selected' : '' }}>Positif</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                        @error('tpha')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- HB -->
                    <div>
                        <label for="hb" class="block text-sm font-medium text-gray-700 mb-1">HB</label>
                        <div class="relative">
                            <select id="hb" name="hb" class="w-full px-3 py-2 border @error('hb') border-red-500 @else border-gray-300 @enderror rounded-md appearance-none pr-10">
                                <option value="Négatif" {{ old('hb', $donation->serology->hb ?? '') == 'Négatif' ? 'selected' : '' }}>Négatif</option>
                                <option value="Positif" {{ old('hb', $donation->serology->hb ?? '') == 'Positif' ? 'selected' : '' }}>Positif</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                        @error('hb')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- HC -->
                    <div>
                        <label for="hc" class="block text-sm font-medium text-gray-700 mb-1">HC</label>
                        <div class="relative">
                            <select id="hc" name="hc" class="w-full px-3 py-2 border @error('hc') border-red-500 @else border-gray-300 @enderror rounded-md appearance-none pr-10">
                                <option value="Négatif" {{ old('hc', $donation->serology->hc ?? '') == 'Négatif' ? 'selected' : '' }}>Négatif</option>
                                <option value="Positif" {{ old('hc', $donation->serology->hc ?? '') == 'Positif' ? 'selected' : '' }}>Positif</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                        @error('hc')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- VIH -->
                    <div>
                        <label for="vih" class="block text-sm font-medium text-gray-700 mb-1">VIH</label>
                        <div class="relative">
                            <select id="vih" name="vih" class="w-full px-3 py-2 border @error('vih') border-red-500 @else border-gray-300 @enderror rounded-md appearance-none pr-10">
                                <option value="Négatif" {{ old('vih', $donation->serology->vih ?? '') == 'Négatif' ? 'selected' : '' }}>Négatif</option>
                                <option value="Positif" {{ old('vih', $donation->serology->vih ?? '') == 'Positif' ? 'selected' : '' }}>Positif</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                        @error('vih')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-between mt-6">
                    <a href="{{ route('Donations.show', $donation->id) }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium">Annuler</a>
                    <button type="submit" class="px-4 py-2 bg-black text-white rounded-md text-sm font-medium flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        Sauvegarder
                    </button>
                </div>
            </div>
        </form>

        <!-- Observations Section -->
        <div class="mt-6 bg-white rounded-md border border-gray-200 overflow-hidden flex flex-col" style="height: 500px;">
            <div class="p-4 border-b border-gray-200">
                <h3 class="font-bold">Observations</h3>
            </div>
            <div class="p-4 flex flex-col h-full">
                <form action="{{ route('Observations.store') }}" method="POST" class="mb-4">
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

                <div class="overflow-y-auto flex-grow">
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
        </div>
    </main>
@endsection
