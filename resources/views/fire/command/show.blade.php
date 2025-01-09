<x-app-layout>
    <div class="space-y-6">
        <!-- Incident Overview -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <h2 class="text-lg font-semibold text-gray-900">Incident #{{ $fire->incident_id }}</h2>
                        <span class="text-sm text-gray-500">{{ $fire->nature }}</span>
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

        <!-- Incident Timer -->
        <div id="incidentTimer" class="hidden mb-6 text-center transition-colors duration-300">
            <div class="inline-flex items-center space-x-2">
                <div class="master-status-dot w-3 h-3 rounded-full bg-green-500 mr-2"></div>
                <div class="inline-flex items-center space-x-2 text-4xl font-bold text-gray-700">
                    <span id="timerHours" class="timer-text">00</span>
                    <span class="timer-text">:</span>
                    <span id="timerMinutes" class="timer-text">00</span>
                    <span class="timer-text">:</span>
                    <span id="timerSeconds" class="timer-text">00</span>
                </div>
            </div>
            <div class="text-sm text-gray-500 mt-1">Incident Duration</div>
        </div>

        <!-- Add CSS for flashing animation -->
        <style>
            @keyframes flash-warning {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.7; }
            }
            .flash-warning {
                animation: flash-warning 2s infinite;
            }
            .timer-text {
                transition: color 0.3s ease;
            }
            .master-status-dot {
                transition: background-color 0.3s ease;
            }
            .draggable-unit {
                background: linear-gradient(to bottom, #ffffff 0%, #f5f5f5 100%);
                border: 1px solid #e5e5e5;
                box-shadow: 
                    inset 0 1px 0 rgba(255,255,255,0.9),
                    0 1px 2px rgba(0,0,0,0.05);
                cursor: move;
                transition: all 0.2s ease;
                user-select: none;
            }
            .draggable-unit:hover {
                background: linear-gradient(to bottom, #f8f8f8 0%, #f0f0f0 100%);
                border-color: #D2691E;
                box-shadow: 
                    inset 0 1px 0 rgba(255,255,255,0.9),
                    0 2px 4px rgba(210,105,30,0.1);
                transform: translateY(-1px);
            }
            .draggable-unit:active {
                background: linear-gradient(to bottom, #f0f0f0 0%, #e8e8e8 100%);
                box-shadow: 
                    inset 0 1px 2px rgba(0,0,0,0.1),
                    0 1px 2px rgba(0,0,0,0.05);
                transform: translateY(0px);
            }
        </style>

        <!-- Unit Assignment Container -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="grid grid-cols-5 gap-6">
                <!-- Available Units Container -->
                <div class="col-span-2 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300 p-4 min-h-[600px]"
                     ondragover="event.preventDefault();"
                     ondrop="handleDrop(event, this)">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-base font-medium text-gray-700">Available Units</h3>
                        <button onclick="editLabel(this)" class="text-xs text-[#D2691E] hover:text-[#A0522D]">Edit</button>
                    </div>
                    <!-- Example Draggable Units -->
                    <div class="space-y-2">
                        <div class="draggable-unit p-3 rounded-md"
                             draggable="true"
                             ondragstart="handleDragStart(event)">
                            <div class="flex items-center">
                                <span class="font-medium text-gray-700">Engine 1</span>
                            </div>
                        </div>
                        <div class="draggable-unit p-3 rounded-md"
                             draggable="true"
                             ondragstart="handleDragStart(event)">
                            <div class="flex items-center">
                                <span class="font-medium text-gray-700">Engine 2</span>
                            </div>
                        </div>
                        <div class="draggable-unit p-3 rounded-md"
                             draggable="true"
                             ondragstart="handleDragStart(event)">
                            <div class="flex items-center">
                                <span class="font-medium text-gray-700">Truck 1</span>
                            </div>
                        </div>
                        <div class="draggable-unit p-3 rounded-md"
                             draggable="true"
                             ondragstart="handleDragStart(event)">
                            <div class="flex items-center">
                                <span class="font-medium text-gray-700">Medic 1</span>
                            </div>
                        </div>
                        <div class="draggable-unit p-3 rounded-md"
                             draggable="true"
                             ondragstart="handleDragStart(event)">
                            <div class="flex items-center">
                                <span class="font-medium text-gray-700">Battalion 1</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Assignment Containers Grid -->
                <div class="col-span-3 grid grid-cols-2 gap-4">
                    <!-- Incident Commander - Special First Position -->
                    <div class="col-span-2 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300 p-4"
                         ondragover="event.preventDefault();"
                         ondrop="handleDrop(event, this)">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-base font-medium text-gray-700">Incident Commander</h3>
                            <button onclick="editLabel(this)" class="text-xs text-[#D2691E] hover:text-[#A0522D]">Edit</button>
                        </div>
                    </div>

                    <!-- Regular Assignment Positions -->
                    @for ($i = 1; $i <= 8; $i++)
                        <div class="bg-gray-50 rounded-lg border-2 border-dashed border-gray-300 p-4"
                             ondragover="event.preventDefault();"
                             ondrop="handleDrop(event, this)">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-sm font-medium text-gray-700">Assignment {{ $i }}</h3>
                                <button onclick="editLabel(this)" class="text-xs text-[#D2691E] hover:text-[#A0522D]">Edit</button>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <script>
            let timerInterval;
            let startTime;
            const TWO_MINUTES = 2 * 60 * 1000; // 2 minutes in milliseconds

            function formatNumber(number) {
                return number.toString().padStart(2, '0');
            }

            function formatTime(milliseconds) {
                const hours = Math.floor(milliseconds / (1000 * 60 * 60));
                const minutes = Math.floor((milliseconds % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((milliseconds % (1000 * 60)) / 1000);
                return `${formatNumber(hours)}:${formatNumber(minutes)}:${formatNumber(seconds)}`;
            }

            function updateMasterTimer() {
                const now = new Date();
                const diff = now - startTime;
                const [hours, minutes, seconds] = formatTime(diff).split(':');
                
                document.getElementById('timerHours').textContent = hours;
                document.getElementById('timerMinutes').textContent = minutes;
                document.getElementById('timerSeconds').textContent = seconds;

                // Check all unit timers
                const allUnits = document.querySelectorAll('[id^="unit-"]');
                let hasOvertime = false;
                
                allUnits.forEach(unit => {
                    if (unit.querySelector('.status-dot')?.classList.contains('bg-red-500')) {
                        hasOvertime = true;
                    }
                });

                const masterTimer = document.getElementById('incidentTimer');
                const masterDot = masterTimer.querySelector('.master-status-dot');
                const timerTexts = masterTimer.querySelectorAll('.timer-text');

                if (hasOvertime) {
                    masterDot.classList.remove('bg-green-500');
                    masterDot.classList.add('bg-red-500');
                    timerTexts.forEach(text => text.classList.add('text-red-600'));
                    masterTimer.classList.add('flash-warning');
                } else {
                    masterDot.classList.add('bg-green-500');
                    masterDot.classList.remove('bg-red-500');
                    timerTexts.forEach(text => text.classList.remove('text-red-600'));
                    timerTexts.forEach(text => text.classList.add('text-green-600'));
                    masterTimer.classList.remove('flash-warning');
                }
            }

            function updateUnitTimer(unitElement) {
                const startTimeAttr = unitElement.getAttribute('data-start-time');
                if (!startTimeAttr) return;

                const unitStartTime = parseInt(startTimeAttr);
                const now = new Date().getTime();
                const diff = now - unitStartTime;
                
                const timerElement = unitElement.querySelector('.unit-timer');
                const statusDot = unitElement.querySelector('.status-dot');
                
                if (timerElement && statusDot) {
                    timerElement.textContent = formatTime(diff);
                    
                    if (diff >= TWO_MINUTES) {
                        timerElement.classList.remove('text-green-600');
                        timerElement.classList.add('text-red-600');
                        statusDot.classList.remove('bg-green-500');
                        statusDot.classList.add('bg-red-500');
                        unitElement.classList.add('flash-warning');
                    } else {
                        timerElement.classList.add('text-green-600');
                        timerElement.classList.remove('text-red-600');
                        statusDot.classList.add('bg-green-500');
                        statusDot.classList.remove('bg-red-500');
                        unitElement.classList.remove('flash-warning');
                    }
                }
            }

            function startTimer() {
                if (!timerInterval) {
                    const timerElement = document.getElementById('incidentTimer');
                    timerElement.classList.remove('hidden');
                    startTime = new Date();
                    timerInterval = setInterval(() => {
                        updateMasterTimer();
                        document.querySelectorAll('[id^="unit-"]').forEach(updateUnitTimer);
                    }, 1000);
                }
            }

            function handleDragStart(event) {
                // Ensure we're dragging the outermost draggable container
                const draggedUnit = event.target.closest('.draggable-unit');
                if (!draggedUnit) return;

                event.dataTransfer.setData('text/plain', draggedUnit.querySelector('.unit-name').textContent.trim());
                event.dataTransfer.setData('sourceId', draggedUnit.id || 'available');
                draggedUnit.classList.add('opacity-50');
            }

            function handleDrop(event, container) {
                event.preventDefault();
                const data = event.dataTransfer.getData('text/plain');
                const sourceId = event.dataTransfer.getData('sourceId');
                
                // Find the source element
                let sourceElement;
                if (sourceId === 'available') {
                    const availableUnits = document.querySelectorAll('.draggable-unit');
                    sourceElement = Array.from(availableUnits).find(el => 
                        el.querySelector('.unit-name')?.textContent.trim() === data
                    );
                } else {
                    sourceElement = document.getElementById(sourceId);
                }

                // Remove the unit from its previous location
                if (sourceElement) {
                    sourceElement.remove();
                }

                // Check if this is the IC position
                const isICPosition = container.querySelector('h3')?.textContent.includes('Incident Commander');

                // Create new element in the target container
                const draggedElement = document.createElement('div');
                draggedElement.className = 'draggable-unit p-3 rounded-md';
                draggedElement.draggable = true;
                draggedElement.ondragstart = function(e) { handleDragStart(e) };
                draggedElement.id = `unit-${Date.now()}`;
                draggedElement.setAttribute('data-start-time', Date.now());

                // Add unit content with timer and status dot
                draggedElement.innerHTML = `
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="status-dot w-2 h-2 rounded-full bg-green-500 mr-2"></div>
                            <span class="unit-name font-medium text-gray-700">${data}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            ${!isICPosition ? `
                                <button onclick="resetUnitTimer(this)" class="text-xs text-[#D2691E] hover:text-[#A0522D] transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                </button>
                            ` : ''}
                            <span class="unit-timer text-xs font-mono text-green-600">00:00:00</span>
                        </div>
                    </div>
                `;

                // Add to the new container
                container.appendChild(draggedElement);

                // Check if this is the IC position and start timer if needed
                if (isICPosition) {
                    startTimer();
                }

                // Start updating this unit's timer
                updateUnitTimer(draggedElement);
            }

            function resetUnitTimer(button) {
                const unitElement = button.closest('.draggable-unit');
                if (unitElement) {
                    unitElement.setAttribute('data-start-time', Date.now());
                    const statusDot = unitElement.querySelector('.status-dot');
                    const timerElement = unitElement.querySelector('.unit-timer');
                    
                    // Reset visual states
                    statusDot.classList.remove('bg-red-500');
                    statusDot.classList.add('bg-green-500');
                    timerElement.classList.remove('text-red-600');
                    timerElement.classList.add('text-green-600');
                    unitElement.classList.remove('flash-warning');
                    
                    // Update the timer immediately
                    updateUnitTimer(unitElement);
                }
            }

            // Update the initial unit HTML to include the unit-name class
            document.querySelectorAll('.draggable-unit').forEach(unit => {
                const unitText = unit.textContent.trim();
                unit.innerHTML = `
                    <div class="flex items-center">
                        <span class="unit-name font-medium text-gray-700">${unitText}</span>
                    </div>
                `;
            });

            function editLabel(button) {
                const header = button.parentElement.querySelector('h3');
                const currentText = header.textContent;
                const input = document.createElement('input');
                input.type = 'text';
                input.value = currentText;
                input.className = 'text-sm border rounded px-2 py-1 w-full';
                
                input.onblur = function() {
                    header.textContent = this.value;
                    this.replaceWith(header);
                };
                
                input.onkeypress = function(e) {
                    if (e.key === 'Enter') {
                        this.blur();
                    }
                };
                
                header.replaceWith(input);
                input.focus();
            }
        </script>

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