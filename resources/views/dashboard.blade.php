<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Vehicle Overview</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                        <a href="{{ route('vehicles.index') }}" class="block h-full hover:shadow-lg transition-shadow duration-200 ease-in-out">
                            <div class="bg-blue-50 p-6 rounded-lg shadow-md flex items-center justify-between border border-blue-200">
                                <div>
                                    <div class="text-sm font-medium text-blue-700">Total Vehicles</div>
                                    <div class="text-4xl font-extrabold text-blue-900 mt-1">{{ $totalVehicles }}</div>
                                </div>
                                <svg class="h-16 w-16 text-blue-500 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a2 2 0 002 2h10a2 2 0 002-2V6h4a2 2 0 002-2V4a2 2 0 00-2-2h-1C9 2 7 6 7 6H3zm9 0v-2m0 0a2 2 0 00-2-2H9.833A2.944 2.944 0 008 2.667C8 2.296 8.296 2 8.667 2h6.666c.371 0 .667.296.667.667v.5"></path>
                                </svg>
                            </div>
                        </a>

                        <a href="{{ route('vehicles.index', ['status' => 'rented']) }}" class="block h-full hover:shadow-lg transition-shadow duration-200 ease-in-out">
                            <div class="bg-green-50 p-6 rounded-lg shadow-md flex items-center justify-between border border-green-200">
                                <div>
                                    <div class="text-sm font-medium text-green-700">Actively Rented</div>
                                    <div class="text-4xl font-extrabold text-green-900 mt-1">{{ $rentedVehicles }}</div>
                                </div>
                                <svg class="h-16 w-16 text-green-500 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h.01M17 13l-4 4m4-4l-4 4m6-4a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </a>

                        {{-- This link will pass two statuses as a comma-separated string. Your VehicleController@index needs to handle this. --}}
                        <a href="{{ route('vehicles.index', ['status' => 'maintenance,unavailable']) }}" class="block h-full hover:shadow-lg transition-shadow duration-200 ease-in-out">
                            <div class="bg-yellow-50 p-6 rounded-lg shadow-md flex items-center justify-between border border-yellow-200">
                                <div>
                                    <div class="text-sm font-medium text-yellow-700">Maint. / Inactive</div>
                                    <div class="text-4xl font-extrabold text-yellow-900 mt-1">{{ $maintenanceVehicles + $unavailableVehicles }}</div>
                                </div>
                                <svg class="h-16 w-16 text-yellow-500 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-.426 1.122-.426 1.548 0L14.4 7.23a1 1 0 00.707.293H18.7a2 2 0 012 2v.417c0 .193-.074.375-.205.517L19.255 14.1a1 1 0 00-.205.517v.417a2 2 0 01-2 2h-.417c-.193 0-.375.074-.517.205L14.1 19.255a1 1 0 00-.517.205v.417a2 2 0 01-2 2H9.833A2.944 2.944 0 008 21.333c0-.371.296-.667.667-.667h6.666c.371 0 .667.296.667.667v.5"></path>
                                </svg>
                            </div>
                        </a>

                        <a href="{{ route('vehicles.index', ['status' => 'available']) }}" class="block h-full hover:shadow-lg transition-shadow duration-200 ease-in-out">
                            <div class="bg-indigo-50 p-6 rounded-lg shadow-md flex items-center justify-between border border-indigo-200">
                                <div>
                                    <div class="text-sm font-medium text-indigo-700">Available Vehicles</div>
                                    <div class="text-4xl font-extrabold text-indigo-900 mt-1">{{ $availableVehicles }}</div>
                                </div>
                                <svg class="h-16 w-16 text-indigo-500 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>