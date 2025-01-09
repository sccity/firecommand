<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-4">Active Fire Incidents</h2>
                    
                    <div class="grid grid-cols-1 gap-4">
                        @foreach($fires as $fire)
                            <div class="border rounded-lg p-4 bg-amber-50">
                                <h3 class="text-lg font-semibold text-amber-900">{{ $fire->type }}</h3>
                                <p class="text-amber-800"><strong>Address:</strong> {{ $fire->address }}</p>
                                <p class="text-amber-800"><strong>Status:</strong> {{ $fire->status }}</p>
                                <p class="text-amber-800"><strong>Priority:</strong> {{ $fire->priority }}</p>
                                
                                <div class="mt-6">
                                    <h4 class="font-semibold text-amber-900 mb-2">Unit Assignments</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <!-- Available Units -->
                                        <div 
                                            class="min-h-[200px] bg-white p-4 rounded-lg border-2 border-dashed border-amber-300"
                                            ondrop="drop(event)"
                                            ondragover="allowDrop(event)"
                                            data-container="available">
                                            <h5 class="font-medium text-amber-800 mb-2">Available Units</h5>
                                            @foreach($unitStatus as $unit)
                                                <div 
                                                    id="unit-{{ $unit['unit'] }}"
                                                    class="bg-amber-100 p-2 mb-2 rounded cursor-move"
                                                    draggable="true"
                                                    ondragstart="drag(event)"
                                                    data-unit="{{ $unit['unit'] }}">
                                                    <span class="text-amber-800 font-semibold">{{ $unit['unit'] }}</span>
                                                    <span class="text-amber-600 text-sm block">{{ $unit['status'] ?? 'Unknown' }}</span>
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- Assignment Boxes -->
                                        @for($i = 1; $i <= 2; $i++)
                                            <div 
                                                class="min-h-[200px] bg-white p-4 rounded-lg border-2 border-dashed border-amber-300"
                                                ondrop="drop(event)"
                                                ondragover="allowDrop(event)"
                                                data-container="assignment-{{ $i }}">
                                                <h5 class="font-medium text-amber-800 mb-2">Assignment {{ $i }}</h5>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Unit Status Panel -->
                    <div class="mt-8 border rounded-lg p-4 bg-amber-50">
                        <h3 class="text-lg font-semibold text-amber-900 mb-4">Unit Status Overview</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
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

    @push('scripts')
    <script>
        // Drag and Drop Functions
        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
            ev.target.classList.add('opacity-50');
        }

        function drop(ev) {
            ev.preventDefault();
            const data = ev.dataTransfer.getData("text");
            const draggedElement = document.getElementById(data);
            const dropZone = ev.target.closest('[data-container]');
            
            if (!dropZone) return;
            
            // Remove opacity class
            draggedElement.classList.remove('opacity-50');
            
            // Move the element to the new container
            dropZone.appendChild(draggedElement);
            
            // Get the unit and new assignment
            const unit = draggedElement.dataset.unit;
            const newAssignment = dropZone.dataset.container;
            
            // You can add an API call here to update the assignment in the backend
            console.log(`Unit ${unit} moved to ${newAssignment}`);
        }

        // Unit Location Updates
        function updateUnitLocations() {
            const units = document.querySelectorAll('[data-unit]');
            units.forEach(unit => {
                const unitId = unit.dataset.unit;
                fetch(`/fire/unit-location?unit=${unitId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.location) {
                            const locationElement = unit.querySelector('.location');
                            if (locationElement) {
                                locationElement.textContent = data.location;
                            }
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