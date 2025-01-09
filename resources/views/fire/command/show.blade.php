<x-app-layout>
    <x-slot name="header">
        Incident #{{ $fire->incident_id }}
    </x-slot>

    <div class="space-y-6">
        <!-- Incident Overview -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div @class([
                            'w-3 h-3 rounded-full',
                            'bg-yellow-400' => $fire->status === 'ENRT',
                            'bg-green-500' => $fire->status === 'ARRVD',
                            'bg-blue-500' => $fire->status === 'ENRTH',
                            'bg-gray-400' => !in_array($fire->status, ['ENRT', 'ARRVD', 'ENRTH'])
                        ])></div>
                        <h2 class="text-lg font-semibold text-gray-900">{{ $fire->nature }}</h2>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#D2691E]/10 text-[#D2691E]">
                            {{ $fire->status }}
                        </span>
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ $fire->date->format('M j, Y g:i A') }}
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 divide-y md:divide-y-0 md:divide-x divide-gray-200">
                <div class="p-6">
                    <h3 class="text-sm font-medium text-gray-500">Location</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-900">{{ $fire->address }}</p>
                        <p class="text-sm text-gray-900">{{ $fire->city }}</p>
                        <p class="mt-1 text-sm text-gray-500">Zone: {{ $fire->zone }}</p>
                    </div>
                </div>

                <div class="p-6">
                    <h3 class="text-sm font-medium text-gray-500">Response</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-900">Unit: {{ $fire->responsible_unit }}</p>
                        <p class="text-sm text-gray-900">Agency: {{ $fire->agency }}</p>
                        <p class="mt-1 text-sm text-gray-500">Time: {{ $fire->status_time }}</p>
                    </div>
                </div>

                <div class="p-6">
                    <h3 class="text-sm font-medium text-gray-500">Coordinates</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-900">Lat: {{ $fire->latitude }}</p>
                        <p class="text-sm text-gray-900">Long: {{ $fire->longitude }}</p>
                        <a href="https://www.google.com/maps?q={{ $fire->latitude }},{{ $fire->longitude }}" 
                           target="_blank"
                           class="mt-2 inline-flex items-center text-sm text-[#D2691E] hover:text-[#A0522D]">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            View on Map
                        </a>
                    </div>
                </div>

                <div class="p-6">
                    <h3 class="text-sm font-medium text-gray-500">Call Details</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-900">Call ID: {{ $fire->call_id }}</p>
                        <p class="text-sm text-gray-900">Call #: {{ $fire->callnum }}</p>
                        <p class="mt-1 text-sm text-gray-500">Type: {{ $fire->type }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex space-x-4">
            <button class="flex-1 flex items-center justify-center px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors group">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                </svg>
                <span class="font-medium">Update Status</span>
            </button>

            <button class="flex-1 flex items-center justify-center px-4 py-3 bg-[#D2691E] text-white rounded-lg hover:bg-[#A0522D] transition-colors group">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span class="font-medium">Assign Resources</span>
            </button>

            <button class="flex-1 flex items-center justify-center px-4 py-3 bg-[#D2691E] text-white rounded-lg hover:bg-[#A0522D] transition-colors group">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span class="font-medium">Add Notes</span>
            </button>
        </div>
    </div>
</x-app-layout> 