$(function () {
    var isDragging = false;

    // Function to get meta tag content safely
    function getMetaContent(name) {
        const meta = document.querySelector(`meta[name="${name}"]`);
        return meta ? meta.getAttribute('content') : null;
    }

    function saveUnitPosition(unit, column, timestamp) {
        const csrfToken = getMetaContent('csrf-token');
        const callId = getMetaContent('call-id');
    
        if (!csrfToken || !callId) {
            console.error('Meta tags for CSRF token or call ID are missing.');
            return;
        }
    
        fetch('/units/save-position', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                unit: unit,
                column: column,
                timestamp: timestamp,
                call_id: callId
            })
        })
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => {
                    console.error('Error response:', text);
                    throw new Error('Network response was not ok');
                });
            }
            return response.json();
        })
        .then(data => {
            console.log('Unit position saved successfully:', data);
        })
        .catch(error => {
            console.error('Error saving unit position:', error);
        });
    }

    // Initialize draggable boxes
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

            // Get the unit name, column name, and current timestamp
            const unitName = droppedBox.data('unitName');
            const columnName = targetContainer.find('.header-column').text().trim();
            const timestamp = new Date().toISOString();

            // Append the box to the target container
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

            // Save the unit's position and timestamp
            saveUnitPosition(unitName, columnName, timestamp);
        }
    });

    // Click event handler for boxes
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

            // Get the unit name, column name, and current timestamp
            const unitName = $(this).data('unitName');
            const columnName = $(this).closest('.column').find('.header-column').text().trim();
            const timestamp = new Date().toISOString();

            // Save the unit's position and timestamp
            saveUnitPosition(unitName, columnName, timestamp);
        }
    });

    function resetTimer() {
        // Implement timer reset logic here
    }
});