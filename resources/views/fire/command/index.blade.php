<x-app-layout class="bg-[#1a1512]">
    <div class="space-y-6 bg-[#1a1512] min-h-screen p-6">
        <!-- System Status -->
        <div class="bg-[#2b2320] rounded-lg shadow-lg border border-[#3d322d]">
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-100">System Status</h2>
                <div class="grid grid-cols-3 gap-4">
                    <!-- Active Incidents -->
                    <div class="bg-[#1a1512] p-4 rounded-lg border border-[#3d322d]">
                        <div class="flex items-center justify-between">
                            <h3 class="text-gray-300">Active Incidents</h3>
                            <div class="text-orange-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-4xl font-bold text-gray-100 mt-2">{{ count($activeFires) }}</p>
                        <p class="text-sm text-gray-400">{{ count($activeFires) }} active {{ Str::plural('emergency', count($activeFires)) }}</p>
                    </div>

                    <!-- Units Deployed -->
                    <div class="bg-[#1a1512] p-4 rounded-lg border border-[#3d322d]">
                        <div class="flex items-center justify-between">
                            <h3 class="text-gray-300">Units Deployed</h3>
                            <div class="text-orange-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-4xl font-bold text-gray-100 mt-2">{{ $activeFires->sum(function($fire) { return count($fire->assignments ?? []); }) }}</p>
                        <p class="text-sm text-gray-400">Units responding</p>
                    </div>

                    <!-- Response Time -->
                    <div class="bg-[#1a1512] p-4 rounded-lg border border-[#3d322d]">
                        <div class="flex items-center justify-between">
                            <h3 class="text-gray-300">Response Time</h3>
                            <div class="text-orange-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-4xl font-bold text-gray-100 mt-2">4:30</p>
                        <p class="text-sm text-gray-400">Average response time</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Incidents -->
        <div class="bg-[#2b2320] rounded-lg shadow-lg border border-[#3d322d]">
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-100">Active Incidents</h2>
                <div class="space-y-4">
                    @foreach($activeFires as $fire)
                        <a href="{{ route('fire.command.show', $fire) }}" 
                           class="block bg-[#1a1512] rounded-lg border border-[#3d322d] p-4 hover:border-orange-400/40">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                    <div>
                                        <h3 class="text-gray-100 font-medium">{{ $fire->type }}</h3>
                                        <p class="text-gray-400 text-sm">{{ $fire->address }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="text-gray-400">{{ $fire->responsible_unit }}</span>
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

       
    </div>

    <style>
        @keyframes flash-warning {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        .flash-warning {
            animation: flash-warning 2s infinite;
        }
    </style>
</x-app-layout> 