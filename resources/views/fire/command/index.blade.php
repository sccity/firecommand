<x-app-layout>
    <x-slot name="header">
        Fire Command Center
    </x-slot>

    <div class="space-y-6">
        <!-- Status Overview -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">System Status</h2>
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 rounded-full bg-green-500"></div>
                        <span class="text-sm font-medium text-green-700">Operational</span>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-gray-200">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-600">Active Incidents</p>
                            <p class="mt-2 text-3xl font-bold text-[#D2691E]">{{ count($activeFires) }}</p>
                            <p class="mt-1 text-sm text-gray-500">
                                {{ count($activeFires) === 0 ? 'No active emergencies' : 
                                   (count($activeFires) === 1 ? '1 active emergency' : count($activeFires) . ' active emergencies') }}
                            </p>
                        </div>
                        <div class="p-3 bg-[#D2691E]/10 rounded-full">
                            <svg class="w-6 h-6 text-[#D2691E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-600">Units Deployed</p>
                            <p class="mt-2 text-3xl font-bold text-[#D2691E]">
                                {{ $activeFires->pluck('responsible_unit')->unique()->count() }}
                            </p>
                            <p class="mt-1 text-sm text-gray-500">Units responding</p>
                        </div>
                        <div class="p-3 bg-[#D2691E]/10 rounded-full">
                            <svg class="w-6 h-6 text-[#D2691E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-600">Response Time</p>
                            <p class="mt-2 text-3xl font-bold text-[#D2691E]">4:30</p>
                            <p class="mt-1 text-sm text-gray-500">Average response time</p>
                        </div>
                        <div class="p-3 bg-[#D2691E]/10 rounded-full">
                            <svg class="w-6 h-6 text-[#D2691E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Incidents -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="text-lg font-semibold text-gray-900">Active Incidents</h2>
            </div>
            
            <div class="divide-y divide-gray-200">
                @forelse ($activeFires as $fire)
                    <a href="{{ route('fire.command.show', $fire) }}" 
                       class="block hover:bg-gray-50 transition-colors">
                        <div class="px-6 py-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        <div @class([
                                            'w-3 h-3 rounded-full',
                                            'bg-yellow-400' => $fire->status === 'ENRT',
                                            'bg-green-500' => $fire->status === 'ARRVD',
                                            'bg-blue-500' => $fire->status === 'ENRTH',
                                            'bg-gray-400' => !in_array($fire->status, ['ENRT', 'ARRVD', 'ENRTH'])
                                        ])></div>
                                    </div>
                                    <div>
                                        <div class="flex items-center space-x-2">
                                            <span class="text-sm font-medium text-gray-900">{{ $fire->nature }}</span>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#D2691E]/10 text-[#D2691E]">
                                                {{ $fire->status }}
                                            </span>
                                        </div>
                                        <div class="mt-1 text-sm text-gray-500">
                                            {{ $fire->address }}, {{ $fire->city }}
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <div class="text-right">
                                        <div class="text-sm font-medium text-gray-900">{{ $fire->responsible_unit }}</div>
                                        <div class="text-sm text-gray-500">{{ $fire->status_time }}</div>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="px-6 py-8 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No active incidents</h3>
                        <p class="mt-1 text-sm text-gray-500">All units are currently available.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="text-lg font-semibold text-gray-900">Quick Actions</h2>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <button class="flex items-center justify-center px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors group">
                        <svg class="w-5 h-5 mr-2 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                        <span class="font-medium">Dispatch Alert</span>
                    </button>

                    <button class="flex items-center justify-center px-4 py-3 bg-[#D2691E] text-white rounded-lg hover:bg-[#A0522D] transition-colors group">
                        <svg class="w-5 h-5 mr-2 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        <span class="font-medium">Status Report</span>
                    </button>

                    <button class="flex items-center justify-center px-4 py-3 bg-[#D2691E] text-white rounded-lg hover:bg-[#A0522D] transition-colors group">
                        <svg class="w-5 h-5 mr-2 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="font-medium">Crew Assignment</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 