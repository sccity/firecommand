@extends('layouts.default')

@section('title', 'View Call')

@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet">
<style>
/* General Styles */
body {
    background-color: #333; /* Dark background */
    font-family: Arial, sans-serif;
}

/* Container for units and assignments */
.container {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

/* Assignment Containers */
.assignment {
    background-color: #444; /* Slightly lighter gray */
    border: 2px solid #555; /* Border in a lighter gray */
    padding: 10px;
    border-radius: 8px;
    flex-grow: 1;
    min-height: 150px; /* Ensure minimum height for drop area */
}

/* Unit Boxes */
.box {
    background-color: #555; /* Slightly darker gray */
    color: white;
    padding: 5px;
    margin: 5px 0;
    border: 1px solid #666;
    border-radius: 5px;
    cursor: pointer;
    font-size: 12px;
    width: 120px; /* Smaller width */
    position: relative;
}

/* Unit Box Header */
.box .unit-header {
    background-color: #FFCC00; /* Yellow header */
    color: #333;
    padding: 5px;
    font-weight: bold;
    text-align: center;
    border-bottom: 1px solid #666;
    border-radius: 5px 5px 0 0;
}

/* Dragging effect */
.dragging {
    opacity: 0.7;
}
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    $(function() {
        $(".box").draggable({
            revert: "invalid",
            helper: "original",
            start: function(event, ui) {
                $(this).data('originalContainer', $(this).parent());
            }
        });

        $(".assignment").droppable({
            accept: ".box",
            drop: function(event, ui) {
                var droppedBox = $(ui.draggable);
                var targetContainer = $(this);
                
                // Move the box to the target container
                droppedBox.appendTo(targetContainer)
                    .css({ top: 'auto', left: 'auto', position: 'relative' });

                // Optionally: Update data or handle more logic here
            }
        });
    });
</script>
@endpush

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-white mb-4">Assign Units</h1>
    <p><strong class="text-white">Call ID:</strong> {{ $call_id }}</p>

    <!-- Available Units -->
    <div class="assignment-container bg-gray-800 border border-gray-600 p-4 mb-4 rounded-lg">
        <h2 class="text-lg font-semibold text-white mb-2">Available Units</h2>
        <div id="unassigned" class="flex flex-wrap gap-2">
            @foreach ($units as $unit)
                <div class="box">
                    <div class="unit-header">{{ $unit['unit'] }}</div>
                    <div class="text-white text-sm">
                        <p><strong>Agency:</strong> {{ $unit['agency'] }}</p>
                        <p><strong>Status:</strong> {{ $unit['status'] }}</p>
                        <p><strong>Elapsed:</strong> {{ $unit['elapsed'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Assignment Containers -->
    <div class="grid grid-cols-2 gap-4">
        @foreach (['IC', 'FA', 'SEARCH', 'VENT', 'RIT', 'DIV A', 'DIV B', 'DIV C', 'DIV D', 'MED'] as $assignment)
            <div class="assignment">
                <h4 class="text-lg font-semibold text-white mb-2">{{ $assignment }}</h4>
                <div id="{{ strtolower(str_replace(' ', '_', $assignment)) }}" class="min-h-[100px]"></div>
            </div>
        @endforeach
    </div>
</div>
@endsection