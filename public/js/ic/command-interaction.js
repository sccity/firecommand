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

    interact('.column').dropzone({
        accept: '.box',
        overlap: 0.5,
        ondrop(event) {
            const droppedBox = $(event.relatedTarget);
            const targetContainer = $(event.target);

            droppedBox.appendTo(targetContainer).css({
                top: 'auto',
                left: 'auto',
                transform: 'none'
            });

            droppedBox.attr('data-x', 0).attr('data-y', 0);

            if (!targetContainer.hasClass('available-units') && !targetContainer.hasClass(
                'ic-column')) {
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

    }
});