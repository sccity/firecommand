@extends('layouts.default')

@section('title', 'View Call')

@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet">
<style>
/* General Styles */
body {
    background-color: #333; /* Dark background */
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    height: 100vh; /* Ensure full viewport height */
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Main Layout */
.container {
    display: flex; /* Flexbox layout */
    flex-direction: column; /* Stack vertically */
    gap: 5px;
    width: 100%; /* Full width */
    height: 95vh; /* Fill most of the viewport height */
    padding: 10px;
    box-sizing: border-box;
}

/* Header Layout */
.header {
    display: grid;
    grid-template-columns: repeat(10, 1fr); /* 10 equal columns */
    gap: 10px;
    align-items: center;
    color: white;
    font-size: 18px;
    text-align: center;
}

/* Assignments Columns Layout */
.assignments-columns {
    display: grid;
    grid-template-columns: repeat(10, 1fr); /* 10 equal columns */
    gap: 10px;
    width: 100%;
    height: 100%; /* Fill available height */
}

/* Individual Column (Units and Assignments) */
.column {
    background-color: #444; /* Original color */
    border: 1px solid #555; /* Original border */
    padding: 25px;
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: flex-start;
    height: 100%; /* Fill available height */
}

/* Column Header */
.column h4 {
    font-size: 16px;
    color: #ffffff; /* Original white text for headers */
    text-align: center;
    margin-bottom: 5px;
    width: 100%;
}

/* Unit Boxes */
.box {
    background-color: #555; /* Original box color */
    color: white;
    padding: 5px;
    margin-bottom: 5px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px; /* Slightly larger font */
    width: 100%;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative; /* To position the green dot */
}

/* Unit Box Header */
.box .unit-header {
    background-color: #FFCC00; /* Original yellow header */
    color: #333;
    padding: 10px;
    font-weight: bold;
    border-bottom: 1px solid #666;
    width: 100%;
}

/* Green Dot */
.green-dot {
    width: 10px;
    height: 10px;
    background-color: #32CD32; /* Green color */
    border-radius: 50%;
    position: absolute;
    top: 5px;
    left: 5px;
    display: none; /* Initially hidden */
}

.assignment .box .green-dot {
    display: block; /* Show green dot when in assignment column */
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

        $(".column").droppable({
            accept: ".box",
            drop: function(event, ui) {
                var droppedBox = $(ui.draggable);
                var targetContainer = $(this);
                droppedBox.appendTo(targetContainer).css({ top: 'auto', left: 'auto', position: 'relative' });
            }
        });
    });
</script>
@endpush

@section('content')
<div class="container">
			<!-- BEGIN panel -->
			<div class="panel panel-inverse" data-sortable-id="ui-widget-18" style="height: 200px;">
				<div class="panel-heading">
					<h4 class="panel-title">Call Details</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
					</div>
				</div>
				<div class="panel-body bg-gray-800 text-white">
					<p>Call information thats important and call timer can go here</p>
				</div>
				<div class="hljs-wrapper">
					<pre><code class="html" data-url="/assets/data/ui-widget-boxes/code-18.json"></code></pre>
				</div>
			</div>
			<!-- END panel -->
			<!-- BEGIN panel -->
			<div class="panel panel-inverse" data-sortable-id="ui-widget-18" style="height: 500px;">
				<div class="panel-heading">
					<h4 class="panel-title">Unit Assignments</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
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
    <div class="column">
        <div id="unassigned" class="flex flex-wrap gap-2">
            @foreach ($units as $unit)
            <div class="box">
                <div class="unit-header">{{ $unit['unit'] }}</div>
                <div class="green-dot"></div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Assignment Columns -->
    @foreach (['IC', 'FA', 'SEARCH', 'VENT', 'RIC', 'MED', 'STAGE', 'DIV A', 'DIV B'] as $assignment)
    <div class="column assignment">
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
						<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
					</div>
				</div>
				<div class="panel-body bg-gray-800 text-white">
					<p>TBD</p>
				</div>
				<div class="hljs-wrapper">
					<pre><code class="html" data-url="/assets/data/ui-widget-boxes/code-18.json"></code></pre>
				</div>
			</div>
			<!-- END panel -->
</div>
@endsection