$(function() {
    var timeoutDuration = 10; // Set the timeout duration here (in seconds)
    var timerInterval;
    var totalSeconds = 0;
    var flashInterval;
    var isFlashing = false;

    function startTimer(display) {
        timerInterval = setInterval(function() {
            totalSeconds++;
            var hours = Math.floor(totalSeconds / 3600);
            var minutes = Math.floor((totalSeconds % 3600) / 60);
            var seconds = totalSeconds % 60;

            hours = hours < 10 ? "0" + hours : hours;
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.text(hours + ":" + minutes + ":" + seconds);

            if (totalSeconds >= timeoutDuration) {
                startFlashingTimer(display);
                $('.assignment .box').each(function() {
                    var box = $(this);
                    if (!box.data('manuallyReset')) {
                        box.find('.green-dot').removeClass('green-dot').addClass('red-dot');
                    }
                });
            }
        }, 1000);
    }

    function startFlashingTimer(display) {
        if (isFlashing) return;
        isFlashing = true;
        flashInterval = setInterval(function() {
            display.toggleClass('timer-flash');
        }, 500);
    }

    function stopFlashingTimer(display) {
        clearInterval(flashInterval);
        isFlashing = false;
        display.removeClass('timer-flash');
    }

    function resetTimer() {
        clearInterval(timerInterval);
        totalSeconds = 0;
        $('#timer').text("00:00:00");
        startTimer($('#timer'));

        $('.assignment .box .red-dot').removeClass('red-dot').addClass('green-dot');
        $('.assignment .box').removeData('manuallyReset');

        stopFlashingTimer($('#timer'));
    }

    function resetDot() {
        var box = $(this);
        box.find('.red-dot').removeClass('red-dot').addClass('green-dot');
        box.data('manuallyReset', true);

        if ($('.assignment .box .red-dot').length === 0) {
            resetTimer();
        }
    }

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

            if (!targetContainer.hasClass('available-units') && !targetContainer.hasClass('ic-column')) {
                droppedBox.find('.dot').remove();
                droppedBox.append('<div class="green-dot dot"></div>');
            } else {
                droppedBox.find('.dot').remove();
            }
        }
    });

    $(document).on('click', '.box', resetDot);

    startTimer($('#timer'));

    $('#reset-timer').on('click', function() {
        resetTimer();
    });
});