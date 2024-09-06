document.addEventListener("DOMContentLoaded", function () {
    const headerRow = document.querySelector('.header');
    const assignmentsColumns = document.getElementById('assignments-columns');
    const incidentTypeDropdown = document.getElementById('incident-type-dropdown');
    const callId = document.querySelector('meta[name="call-id"]').getAttribute('content'); // Get the call ID
    let debounceTimer = null;

    const columnsConfig = {
        "Structure Fire": ["IC", "FA", "SEARCH", "VENT", "RIT", "MED", "DRONE", "DIV A", "DIV B"],
        "Brush Fire": ["IC", "IA", "DIV A", "DIV B", "DIV C", "DIV D", "DRONE", "STAGE", "MED"],
        "Other Fire": ["IC", "FA", "DIV A", "DIV B", "DIV C", "DIV D", "DRONE", "STAGE", "MED"],
        "Medical": ["IC", "MED", "STAGE", "ALT 1", "ALT 2", "ALT 3", "ALT 4", "DIV A", "DIV B"],
        "MCI": ["IC", "MED A", "MED B", "MED C", "MED D", "DIV A", "DIV B", "DIV C", "DIV D"],
        "Other": ["IC", "OTH 1", "OTH 2", "OTH 3", "OTH 4", "OTH 5", "OTH 6", "OTH 7", "OTH 8"]
    };

    // Load columns from server
    function loadColumns() {
        fetch(`/columns/${callId}`)
            .then(response => response.json())
            .then(data => {
                if (Array.isArray(data)) { // Ensure the data is an array
                    renderColumns(data);
                    enableHeaderEditing();
                } else {
                    console.error('Unexpected data format:', data);
                }
            })
            .catch(error => {
                console.error('Error loading columns:', error);
            });
    }

    function renderColumns(columns) {
        // Clear existing columns
        headerRow.innerHTML = '';

        const fragment = document.createDocumentFragment(); // Use a fragment for better performance
        columns.forEach(columnName => {
            if (columnName) { // Check if columnName is not empty
                const headerDiv = document.createElement('div');
                headerDiv.className = 'header-column';
                headerDiv.textContent = columnName;
                fragment.appendChild(headerDiv);
            }
        });
        headerRow.appendChild(fragment); // Append the fragment in a single operation
    }

    function enableHeaderEditing() {
        const headerColumns = headerRow.querySelectorAll('.header-column');
        headerColumns.forEach(header => {
            header.addEventListener('click', function () {
                const currentText = header.textContent;
                const input = document.createElement('input');
                input.type = 'text';
                input.value = currentText;
                input.style.width = `${header.offsetWidth}px`;
                input.maxLength = 8; // Limit input length to 8 characters

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
        header.textContent = newValue.trim().slice(0, 8) || oldValue; // Limit display to 8 characters

        debounceTimer = setTimeout(() => {
            saveColumns();
        }, 300); // Delay save by 300ms
    }

    function saveColumns() {
        const columns = Array.from(headerRow.querySelectorAll('.header-column')).map(header => {
            return header.textContent.trim().slice(0, 8) || ''; // Ensure saved value is limited to 8 characters
        });

        fetch('/columns/save', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                call_id: callId,
                columns: columns
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

    // Function to update columns based on incident type
    function updateAssignmentColumns(incidentType) {
        const existingColumns = document.querySelectorAll('.assignment, .ic-column');
        existingColumns.forEach(column => column.remove());

        while (headerRow.children.length > 1) {
            headerRow.removeChild(headerRow.lastChild);
        }

        const selectedColumns = columnsConfig[incidentType];

        selectedColumns.forEach(column => {
            const headerDiv = document.createElement('div');
            headerDiv.className = 'header-column';
            headerDiv.textContent = column;
            headerRow.appendChild(headerDiv);

            const columnDiv = document.createElement('div');
            columnDiv.className = column === "IC" ? "column ic-column" : "column assignment";
            columnDiv.id = column.toLowerCase().replace(/ /g, '_');
            columnDiv.innerHTML = `<div class="flex-grow"></div>`;
            assignmentsColumns.appendChild(columnDiv);
        });

        enableHeaderEditing();
        saveColumns(); // Save columns whenever they are updated
    }

    // Initialize draggable functionality for boxes
    $(function () {
        var isDragging = false;
    
        interact('.box').draggable({
            inertia: true,
            autoScroll: true,
            listeners: {
                start(event) {
                    isDragging = true;
                },
                move(event) {
                    const target = event.target;
                    const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
                    const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;
    
                    target.style.transform = `translate(${x}px, ${y}px)`;
                    target.setAttribute('data-x', x);
                    target.setAttribute('data-y', y);
                },
                end(event) {
                    isDragging = false;
                }
            }
        });

        // Initialize drop zones
        interact('.column').dropzone({
            accept: '.box',
            overlap: 0.5,
            ondrop(event) {
                const droppedBox = $(event.relatedTarget);
                const targetContainer = $(event.target);

                const unitName = droppedBox.data('unitName');
                const columnName = targetContainer.find('.header-column').text().trim();
                const timestamp = new Date().toISOString();

                droppedBox.appendTo(targetContainer).css({
                    top: 'auto',
                    left: 'auto',
                    transform: 'none'
                });

                droppedBox.attr('data-x', 0).attr('data-y', 0);

                if (!targetContainer.hasClass('available-units') && !targetContainer.hasClass('ic-column')) {
                    droppedBox.find('.dot').remove();
                    droppedBox.append('<div class="green-dot dot"></div>');
                } else {
                    droppedBox.find('.dot').remove();
                }
            }
        });
    
        $(document).on('click', '.box', function () {
            if (!isDragging) {
                var dot = $(this).find('.dot');
                if (dot.hasClass('red-dot')) {
                    dot.removeClass('red-dot').addClass('green-dot');
                }
                $(this).data('manuallyReset', true);

                if ($('.assignment .box').length === $('.assignment .box .green-dot').length) {
                    resetTimer();
                }
            }
        });

        function resetTimer() {
            // Implement timer reset logic here
        }
    });

    // Initialize columns based on default incident type
    incidentTypeDropdown.addEventListener('change', function () {
        const selectedIncidentType = this.value;
        updateAssignmentColumns(selectedIncidentType);
    });

    // Initial load of columns
    loadColumns();
});