document.addEventListener("DOMContentLoaded", function () {
    const headerRow = document.querySelector('.header');
    let debounceTimer = null;

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
                }, { passive: true });

                input.addEventListener('keydown', function (event) {
                    if (event.key === 'Enter') {
                        handleColumnUpdate(header, input.value);
                    }
                }, { passive: true });
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

        console.log('Columns to save:', columns); // Debugging line

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
            console.log('Response data:', data); // Debugging line
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

    loadColumns();
});