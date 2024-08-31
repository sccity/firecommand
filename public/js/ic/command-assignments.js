document.addEventListener("DOMContentLoaded", function () {
    const assignmentsColumns = document.getElementById('assignments-columns');
    const incidentTypeDropdown = document.getElementById('incident-type-dropdown');
    const headerRow = document.querySelector('.header');

    const columnsConfig = {
        "Structure Fire": ["IC", "FA", "SEARCH", "VENT", "RIT", "MED", "DRONE", "DIV A", "DIV B"],
        "Brush Fire": ["IC", "IA", "DIV A", "DIV B", "DIV C", "DIV D", "DRONE", "STAGE", "MED"],
        "Other Fire": ["IC", "FA", "DIV A", "DIV B", "DIV C", "DIV D", "DRONE", "STAGE", "MED"],
        "Medical": ["IC", "MED", "STAGE", "ALT 1", "ALT 2", "ALT 3", "ALT 4", "DIV A", "DIV B"],
        "MCI": ["IC", "MED A", "MED B", "MED C", "MED D", "DIV A", "DIV B", "DIV C", "DIV D"],
        "Other": ["IC", "OTH 1", "OTH 2", "OTH 3", "OTH 4", "OTH 5", "OTH 6", "OTH 7", "OTH 8"]
    };

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
    }

    function enableHeaderEditing() {
        const headerColumns = headerRow.querySelectorAll('.header-column');
        headerColumns.forEach(header => {
            if (header.textContent !== 'Units' && header.textContent !== 'IC') {
                header.addEventListener('click', function () {
                    const currentText = header.textContent;
                    const input = document.createElement('input');
                    input.type = 'text';
                    input.value = currentText;
                    input.style.width = `${header.offsetWidth}px`;

                    header.innerHTML = '';
                    header.appendChild(input);
                    input.focus();

                    input.addEventListener('blur', function () {
                        header.textContent = input.value || currentText;
                    });

                    input.addEventListener('keydown', function (event) {
                        if (event.key === 'Enter') {
                            header.textContent = input.value || currentText;
                        }
                    });
                });
            }
        });
    }

    updateAssignmentColumns("Structure Fire");

    incidentTypeDropdown.addEventListener('change', function () {
        const selectedIncidentType = this.value;
        updateAssignmentColumns(selectedIncidentType);
    });
});