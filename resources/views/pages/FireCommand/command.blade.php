@extends('layouts.default')

@section('title', 'IC')

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons-core.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #333;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            display: flex;
            flex-direction: column;
            gap: 5px;
            width: 100%;
            height: 95vh;
            padding: 10px;
            box-sizing: border-box;
        }

        .header {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            gap: 10px;
            align-items: center;
            color: white;
            font-size: 18px;
            text-align: center;
        }

        .assignments-columns {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            gap: 10px;
            width: 100%;
            height: 100%;
        }

        .column {
            background-color: #444;
            border: 1px solid #555;
            padding: 25px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
            height: 100%;
        }

        .column h4 {
            font-size: 16px;
            color: #ffffff;
            text-align: center;
            margin-bottom: 5px;
            width: 100%;
        }

        .box {
            background-color: #555;
            color: white;
            padding: 5px;
            margin-bottom: 5px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            width: 100%;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .box .unit-header {
            background-color: #FFCC00;
            color: #333;
            padding: 10px;
            font-weight: bold;
            border-bottom: 1px solid #666;
            width: 100%;
        }

        .green-dot {
            width: 10px;
            height: 10px;
            background-color: #32CD32;
            border-radius: 50%;
            position: absolute;
            top: 5px;
            left: 5px;
        }

        .red-dot {
            width: 10px;
            height: 10px;
            background-color: #FF0000;
            border-radius: 50%;
            position: absolute;
            top: 5px;
            left: 5px;
        }

        .timer-flash {
            color: #FF0000;
        }

        .assignment .box .green-dot {
            display: block;
        }

        .dragging {
            opacity: 0.7;
        }

        .timer {
            font-size: 48px;
            font-weight: bold;
            color: #FFCC00;
            text-align: right;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@interactjs/interactjs@1.10.11/dist/interact.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@interactjs/interactjs@1.10.11/dist/interact.min.js"></script>
    <script>
        $(function() {
            var isDragging = false;

            // Initialize interact.js for drag-and-drop
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

                    if (!targetContainer.hasClass('available-units') && !targetContainer.hasClass('ic-column')) {
                        droppedBox.find('.dot').remove();
                        droppedBox.append('<div class="green-dot dot"></div>');
                    } else {
                        droppedBox.find('.dot').remove();
                    }
                }
            });

            // Handle click/tap for toggling the dot
            $(document).on('click', '.box', function() {
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

            // Function to reset the timer (add your existing logic here)
            function resetTimer() {
                // Your existing timer reset logic
            }
        });
    </script>
    <script>
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
                            if (!$(this).data('manuallyReset')) {
                                $(this).find('.green-dot').removeClass('green-dot').addClass(
                                    'red-dot');
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
                $(this).find('.red-dot').removeClass('red-dot').addClass('green-dot');
                $(this).data('manuallyReset', true);

                if ($('.assignment .box').length === $('.assignment .box .green-dot').length) {
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

                    if (!targetContainer.hasClass('available-units') && !targetContainer.hasClass(
                            'ic-column')) {
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
    </script>
@endpush

@section('content')

    <div class="container">
        <h1>{{ $nature }} - {{ $address }}</h1>
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-3 -->
            <div class="col-xl-3 col-md-6">
            </div>
            <!-- END col-3 -->
            <!-- BEGIN col-3 -->
            <div class="col-xl-3 col-md-6">
            </div>
            <!-- END col-3 -->
            <!-- BEGIN col-3 -->
            <div class="col-xl-3 col-md-6">
            </div>
            <!-- END col-3 -->
            <!-- BEGIN col-3 -->
            <div class="col-xl-3 col-md-6">
                <div class="widget widget-stats bg-red">
                    <div class="stats-icon"></div>
                    <div class="stats-info" style="text-align: center;">
                        <p id="timer" style="font-size: 40px; font-weight: bold;">00:00:00</p>
                    </div>
                    <div class="stats-link" style="text-align: center;">
                        <a href="javascript:;" id="reset-timer">Reset PAR</a>
                    </div>
                </div>
            </div>
            <!-- END col-3 -->
        </div>
        <!-- END row -->
        <!-- BEGIN panel -->
        <div class="panel panel-inverse" data-sortable-id="ui-widget-18" style="height: 500px;">
            <div class="panel-heading">
                <h4 class="panel-title">Unit Assignments</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body bg-gray-800 text-white">
                <!-- Header -->
                <div class="header">
                    <h4>Units</h4>
                    <h4>IC</h4>
                    <h4>FA</h4>
                    <h4>SEARCH</h4>
                    <h4>VENT</h4>
                    <h4>RIC</h4>
                    <h4>MED</h4>
                    <h4>STAGE</h4>
                    <h4>DIV A</h4>
                    <h4>DIV B</h4>
                </div>

                <!-- Columns (Units + Assignments) -->
                <div class="assignments-columns">
                    <!-- Units Column -->
                    <div class="column available-units">
                        <div id="unassigned" class="flex flex-wrap gap-2">
                            @foreach ($units as $unit)
                                <div class="box">
                                    <div class="unit-header">{{ $unit['unit'] }}</div>
                                    <!-- No dot here for available units -->
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Assignment Columns -->
                    @foreach (['IC', 'FA', 'SEARCH', 'VENT', 'RIC', 'MED', 'STAGE', 'DIV A', 'DIV B'] as $assignment)
                        <div class="column @if ($assignment == 'IC') ic-column @else assignment @endif">
                            <div id="{{ strtolower(str_replace(' ', '_', $assignment)) }}" class="flex-grow"></div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="hljs-wrapper">
                <pre><code class="html" data-url="/assets/data/ui-widget-boxes/code-18.json"></code></pre>
            </div>
        </div>
        <!-- END panel -->
        <!-- BEGIN panel -->
        <div class="panel panel-inverse" data-sortable-id="ui-widget-18" style="height: 300px;">
            <div class="panel-heading">
                <h4 class="panel-title">CAD Comments</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body bg-gray-800 text-white">
                {!! str_replace(['{', '}'], '', $comments) !!}
            </div>
            <div class="hljs-wrapper">
                <pre><code class="html" data-url="/assets/data/ui-widget-boxes/code-18.json"></code></pre>
            </div>
        </div>
        <!-- END panel -->
    </div>
@endsection
