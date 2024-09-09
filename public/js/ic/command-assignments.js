document.addEventListener("DOMContentLoaded", function () {
    const headerRow = document.querySelector('.header');
    const assignmentsColumns = document.getElementById('assignments-columns');
    const incidentTypeDropdown = document.getElementById('incident-type-dropdown');
    const callId = document.querySelector('.container').dataset.callId;
    let debounceTimer = null;
    let timerInterval;
    let totalSeconds = 0;
    let flashInterval;
    let isFlashing = false;
    const timeoutDuration = 10 * 60 * 1000; // 10 minutes in milliseconds
    const timerDisplay = document.getElementById('timer');

    const columnsConfig = {
        "Structure Fire": ["Units", "IC", "FA", "SEARCH", "VENT", "RIT", "MED", "DRONE", "DIV A", "DIV B"],
        "Brush Fire": ["Units", "IC", "IA", "DIV A", "DIV B", "DIV C", "DIV D", "DRONE", "STAGE", "MED"],
        "Other Fire": ["Units", "IC", "FA", "DIV A", "DIV B", "DIV C", "DIV D", "DRONE", "STAGE", "MED"],
        "Medical": ["Units", "IC", "MED", "STAGE", "ALT 1", "ALT 2", "ALT 3", "ALT 4", "DIV A", "DIV B"],
        "MCI": ["Units", "IC", "MED A", "MED B", "MED C", "MED D", "DIV A", "DIV B", "DIV C", "DIV D"],
        "Other": ["Units", "IC", "OTH 1", "OTH 2", "OTH 3", "OTH 4", "OTH 5", "OTH 6", "OTH 7", "OTH 8"]
    };

    function loadColumns() {
        fetch(`/columns/${callId}`)
            .then(response => response.json())
            .then(data => {
                if (Array.isArray(data)) {
                    let fixedColumns = ["Units", "IC"];
                    let otherColumns = data.filter(col => !fixedColumns.includes(col));
                    data = [...fixedColumns, ...otherColumns];
    
                    renderColumns(data);
                    enableHeaderEditing();
    
                    let isCustom = true;
                    for (const [incidentType, columns] of Object.entries(columnsConfig)) {
                        const normalizedData = [...new Set(data)];
                        const normalizedConfig = [...new Set(columns)];
                        
                        if (JSON.stringify(normalizedData) === JSON.stringify(normalizedConfig)) {
                            incidentTypeDropdown.value = incidentType;
                            isCustom = false;
                            break;
                        }
                    }
    
                    if (isCustom) {
                        incidentTypeDropdown.value = "Custom";
                    }
    
                    renderAssignmentColumns(data);
                } else {
                    console.error('Unexpected data format:', data);
                }
            })
            .catch(error => {
                console.error('Error loading columns:', error);
            });
    }

    function renderColumns(columns) {
        console.log(`Rendering columns: ${columns}`);
        headerRow.innerHTML = '';
    
        const fragment = document.createDocumentFragment();
        columns.forEach((columnName) => {
            if (columnName) {
                const headerDiv = document.createElement('div');
                headerDiv.className = 'header-column';
                headerDiv.textContent = columnName;
                fragment.appendChild(headerDiv);
            }
        });
        headerRow.appendChild(fragment);
    
        initializeDragAndDrop();
    }

    function enableHeaderEditing() {
        const headerColumns = headerRow.querySelectorAll('.header-column');
        headerColumns.forEach(header => {
            header.addEventListener('click', function () {
                if (header.textContent === "Units" || header.textContent === "IC") return;

                const currentText = header.textContent;
                const input = document.createElement('input');
                input.type = 'text';
                input.value = currentText;
                input.style.width = `${header.offsetWidth}px`;
                input.maxLength = 8;

                header.innerHTML = '';
                header.appendChild(input);
                input.focus();

                input.addEventListener('blur', function() {
                    handleColumnUpdate(header, input.value);
                });

                input.addEventListener('keydown', function (event) {
                    if (event.key === 'Enter') {
                        handleColumnUpdate(header, input.value);
                    }
                });
            });
        });
    }

    function handleColumnUpdate(header, newValue) {
        clearTimeout(debounceTimer);

        const oldValue = header.textContent;
        header.textContent = newValue.trim().slice(0, 8) || oldValue;

        debounceTimer = setTimeout(() => {
            saveColumns();
        }, 300);
    }

    function saveColumns() {
        const columns = Array.from(headerRow.querySelectorAll('.header-column')).map(header => {
            return header.textContent.trim().slice(0, 8) || '';
        });

        const uniqueColumns = ["Units", "IC", ...new Set(columns.filter(col => col !== "Units" && col !== "IC"))];
        
        fetch('/columns/save', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                call_id: callId,
                columns: uniqueColumns
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                console.log('Columns saved successfully');
            } else {
                console.error('Error saving columns:', data.message);
            }
        })
        .catch(error => {
            console.error('Error saving columns:', error);
        });
    }

    function renderAssignmentColumns(columns) {
        console.log(`Rendering assignment columns: ${columns}`);
        const currentColumns = Array.from(assignmentsColumns.children);
        
        currentColumns.forEach(col => {
            if (!col.classList.contains('available-units')) {
                col.remove();
            }
        });
        
        const fragment = document.createDocumentFragment();
        columns.forEach(column => {
            if (column && column !== "Units" && column !== "IC") {
                const columnDiv = document.createElement('div');
                columnDiv.className = "column assignment";
                columnDiv.id = column.toLowerCase().replace(/ /g, '_');
                columnDiv.innerHTML = `<div class="flex-grow"></div>`;
                fragment.appendChild(columnDiv);
            }
        });
        assignmentsColumns.appendChild(fragment);
    
        setTimeout(() => {
            initializeDragAndDrop();
        }, 0);
    }

    function updateAssignmentColumns(incidentType) {
        console.log(`Updating columns for incident type: ${incidentType}`);
        if (incidentType === "Custom") {
            return;
        }

        const selectedColumns = columnsConfig[incidentType] || [];
        const allColumns = ["Units", "IC", ...selectedColumns];

        console.log(`Selected columns: ${selectedColumns}`);
        console.log(`All columns: ${allColumns}`);
        
        const existingColumns = Array.from(headerRow.querySelectorAll('.header-column')).map(header => header.textContent.trim());
        const uniqueColumns = [...new Set(allColumns)];
        if (existingColumns.join(',') !== uniqueColumns.join(',')) {
            renderColumns(uniqueColumns);
            renderAssignmentColumns(uniqueColumns);
            saveColumns();
        }
    }

    function sendUnitPositionUpdate(unitId, columnId) {
        fetch('/unit-positions/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                unit_id: unitId,
                column_id: columnId,
                call_id: document.querySelector('.container').dataset.callId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                console.log('Unit position updated successfully');
            } else {
                console.error('Error updating unit position:', data.message);
            }
        })
        .catch(error => {
            console.error('Error updating unit position:', error);
        });
    }
    function initializeUnitPositions() {
        fetch('/unit-positions/initialize', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                call_id: document.querySelector('.container').dataset.callId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                console.log('Unit positions initialized');
            } else {
                console.error('Error initializing unit positions:', data.message);
            }
        })
        .catch(error => {
            console.error('Error initializing unit positions:', error);
        });
    }

    
    function initializeDragAndDrop() {
        console.log('Initializing drag and drop');
    
        $(".box").draggable({
            revert: "invalid",
            helper: "original",
            start: function(event, ui) {
                $(this).data('originalContainer', $(this).parent());
            }
        });
    
        $(".column").droppable({
            accept: ".box",
            drop: function(event, ui) {
                var droppedBox = $(ui.draggable);
                var targetContainer = $(this);
                droppedBox.appendTo(targetContainer).css({
                    top: 'auto',
                    left: 'auto',
                    position: 'relative'
                });
    
                var unitId = droppedBox.data('unitId'); // Ensure this is set somewhere in your code
                var columnId = targetContainer.data('columnId'); // Ensure this is set somewhere in your code
    
                sendUnitPositionUpdate(unitId, columnId);
    
                if (!targetContainer.hasClass('available-units') && !targetContainer.hasClass('ic-column')) {
                    droppedBox.find('.dot').remove();
                    droppedBox.append('<div class="green-dot dot"></div>');
                } else {
                    droppedBox.find('.dot').remove();
                }
            }
        });
    }

    function startBoxTimer(box) {
        box.dataset.startTime = Date.now();
        setInterval(() => {
            const elapsed = Date.now() - box.dataset.startTime;
            if (elapsed >= timeoutDuration) {
                turnBoxRed(box);
                startFlashingTimer();
            }
        }, 1000);
    }

    function resetBoxTimer(box) {
        if (box.dataset.startTime) {
            box.dataset.startTime = Date.now();
            turnBoxGreen(box);
            stopFlashingTimer();
        } else {
            startBoxTimer(box);
        }
    }

    function turnBoxRed(box) {
        const greenDot = box.querySelector('.green-dot');
        if (greenDot) {
            greenDot.classList.replace('green-dot', 'red-dot');
            checkForRedLights();
        }
    }

    function turnBoxGreen(box) {
        const redDot = box.querySelector('.red-dot');
        if (redDot) {
            redDot.classList.replace('red-dot', 'green-dot');
        }
        if (document.querySelectorAll('.red-dot').length === 0) {
            stopFlashingTimer();
        }
    }

    function checkForRedLights() {
        if (document.querySelectorAll('.red-dot').length > 0) {
            startFlashingTimer();
        }
    }

    function startTimer(display) {
        timerInterval = setInterval(() => {
            totalSeconds++;
            const hours = String(Math.floor(totalSeconds / 3600)).padStart(2, '0');
            const minutes = String(Math.floor((totalSeconds % 3600) / 60)).padStart(2, '0');
            const seconds = String(totalSeconds % 60).padStart(2, '0');

            display.textContent = `${hours}:${minutes}:${seconds}`;

            if (totalSeconds >= timeoutDuration / 1000) {
                document.querySelectorAll('.assignment .box').forEach(function(box) {
                    if (!box.querySelector('.red-dot')) {
                        turnBoxRed(box);
                    }
                });
            }
        }, 1000);
    }

    function startFlashingTimer() {
        if (isFlashing) return;
        isFlashing = true;
        flashInterval = setInterval(() => {
            timerDisplay.classList.toggle('timer-flash');
        }, 500);
    }

    function stopFlashingTimer() {
        clearInterval(flashInterval);
        isFlashing = false;
        timerDisplay.classList.remove('timer-flash');
    }

    function resetTimer() {
        clearInterval(timerInterval);
        totalSeconds = 0;
        timerDisplay.textContent = "00:00:00";
        startTimer(timerDisplay);

        document.querySelectorAll('.assignment .box .red-dot').forEach(function(dot) {
            dot.classList.remove('red-dot');
            dot.classList.add('green-dot');
        });
        stopFlashingTimer();
    }

    function resetDot() {
        const box = this;
        turnBoxGreen(box);
        if (document.querySelectorAll('.assignment .box .red-dot').length === 0) {
            resetTimer();
        }
    }

    document.querySelectorAll(".box").forEach(box => {
        box.addEventListener('click', resetDot);
    });

    document.getElementById('reset-timer').addEventListener('click', resetTimer);

    incidentTypeDropdown.addEventListener('change', function () {
        updateAssignmentColumns(this.value);
    });

    loadColumns();
    startTimer(timerDisplay);
});