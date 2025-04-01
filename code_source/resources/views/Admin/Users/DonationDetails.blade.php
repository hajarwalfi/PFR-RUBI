@extends('Admin.layouts.aside')
@section('title', 'RUBI Admin - Détails de don')

@section('content')
    <main class="flex-1">

      <!-- Navigation -->
      <div class="p-4 flex justify-between items-center border-b border-gray-200">
        <div class="flex items-center space-x-2">
          <a href="#" class="inline-flex items-center p-2 rounded-md hover:bg-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
          </a>
          <span class="text-gray-500">Donneurs > Dossier Médical > Détails du don</span>
        </div>

        <button class="bg-black text-white px-4 py-2 rounded-md flex items-center space-x-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
          </svg>
          <span>Modifier</span>
        </button>
      </div>

      <!-- Informations du don -->
      <section class="p-6">
        <!-- ID et date -->
        <section class="mb-6">
          <h2 class="text-2xl font-bold mb-1">DON-2022-089</h2>
          <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span class="text-gray-600">10/01/2023</span>
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
                      <div class="w-1/2 flex items-start">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                          </svg>
                          <div>
                              <p class="text-gray-600 text-sm">Date du don</p>
                              <p class="font-medium">10/01/2023</p>
                          </div>
                      </div>
                      <div class="w-1/2 flex items-start">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                          </svg>
                          <div>
                              <p class="text-gray-600 text-sm">Quantité prélevée</p>
                              <p class="font-medium">450 ml</p>
                          </div>
                      </div>
                  </div>

                  <!-- Lieu et opérateur -->
                  <div class="p-4 flex">
                      <div class="w-1/2 flex items-start">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                          </svg>
                          <div>
                              <p class="text-gray-600 text-sm">Lieu du don</p>
                              <p class="font-medium">CRTS Safi</p>
                          </div>
                      </div>
                      <div class="w-1/2 flex items-start">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                          </svg>
                          <div>
                              <p class="text-gray-600 text-sm">Opérateur</p>
                              <p class="font-medium">Dr. Hajer Walfi</p>
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
                              <div class="flex items-center text-green-600">
                                  <svg class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                  </svg>
                                  <span>Négative</span>
                              </div>
                          </div>

                          <!-- HB -->
                          <div class="border border-gray-200 rounded-lg p-3">
                              <div class="font-medium mb-2">HB</div>
                              <div class="flex items-center text-green-600">
                                  <svg class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                  </svg>
                                  <span>Négative</span>
                              </div>
                          </div>

                          <!-- HC -->
                          <div class="border border-gray-200 rounded-lg p-3">
                              <div class="font-medium mb-2">HC</div>
                              <div class="flex items-center text-green-600">
                                  <svg class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                  </svg>
                                  <span>Négative</span>
                              </div>
                          </div>

                          <!-- VIH -->
                          <div class="border border-gray-200 rounded-lg p-3">
                              <div class="font-medium mb-2">VIH</div>
                              <div class="flex items-center text-green-600">
                                  <svg class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                  </svg>
                                  <span>Négative</span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <div class="col-span-5 border border-gray-200 rounded-lg overflow-hidden">
              <div class="p-4 border-b border-gray-200">
                  <h3 class="font-bold">Observations</h3>
              </div>
              <div class="p-4">
  <textarea
      class="w-full h-32 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-gray-400 resize-none"
      placeholder="Ajouter une observation sur le don effectué..."
  ></textarea>
                  <div class="mt-3 flex justify-end">
                      <button class="bg-black text-white px-4 py-2 rounded-md flex items-center text-sm">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                          </svg>
                          Ajouter
                      </button>
                  </div>
                  <div class="border mt-6 border-gray-200 rounded-lg p-3 text-sm text-gray-500">
                      Don effectué sans complications
                  </div>
              </div>
          </div>
      </section>
     </section>
    </main>
@endsection
