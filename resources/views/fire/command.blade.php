<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-4">Active Fire Incidents</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-4">
                            @foreach($fires as $fire)
                                <div class="border rounded-lg p-4 bg-amber-50">
                                    <h3 class="text-lg font-semibold text-amber-900">{{ $fire->type }}</h3>
                                    <p class="text-amber-800"><strong>Address:</strong> {{ $fire->address }}</p>
                                    <p class="text-amber-800"><strong>Status:</strong> {{ $fire->status }}</p>
                                    <p class="text-amber-800"><strong>Priority:</strong> {{ $fire->priority }}</p>
                                    
                                    @if($fire->assigned_units)
                                        <div class="mt-2">
                                            <h4 class="font-semibold text-amber-900">Assigned Units:</h4>
                                            <div class="grid grid-cols-2 gap-2 mt-1">
                                                @foreach($fire->assigned_units as $unit)
                                                    <div class="bg-amber-100 p-2 rounded">
                                                        <span class="text-amber-800">{{ $unit['unit'] }}</span>
                                                        <span class="text-amber-600 text-sm block">{{ $unit['status'] ?? 'Unknown' }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <div class="border rounded-lg p-4 bg-amber-50">
                            <h3 class="text-lg font-semibold text-amber-900 mb-4">Unit Status</h3>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach($unitStatus as $unit)
                                    <div class="bg-amber-100 p-2 rounded" data-unit="{{ $unit['unit'] }}">
                                        <span class="text-amber-800 font-semibold">{{ $unit['unit'] }}</span>
                                        <span class="text-amber-600 text-sm block">{{ $unit['status'] ?? 'Unknown' }}</span>
                                        <span class="text-amber-600 text-sm block location">{{ $unit['location'] ?? 'Location unknown' }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function updateUnitLocations() {
            const units = document.querySelectorAll('[data-unit]');
            units.forEach(unit => {
                const unitId = unit.dataset.unit;
                fetch(`/fire/unit-location?unit=${unitId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.location) {
                            unit.querySelector('.location').textContent = data.location;
                        }
                    });
            });
        }

        // Update locations every 30 seconds
        setInterval(updateUnitLocations, 30000);
        
        // Initial update
        updateUnitLocations();
    </script>
    @endpush
</x-app-layout> 