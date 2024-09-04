@extends('layouts.default')

@section('title', 'IC')

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet">
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.6.0/mapbox-gl.css" rel="stylesheet">
    <link href="{{ asset('css/ic-command.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/interact.js/1.0.2/interact.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.6.0/mapbox-gl.js"></script>
    <script src="{{ asset('js/ic/command-par.js') }}"></script>
    <script src="{{ asset('js/ic/command-interaction.js') }}"></script>
    <script src="{{ asset('js/ic/command-updatedata.js') }}"></script>
    <script src="{{ asset('js/ic/command-assignments.js') }}"></script>
    
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const callId = document.querySelector('.container').dataset.callId;
    const headerRow = document.querySelector('.header');

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

        columns.forEach(columnName => {
            if (columnName) { // Check if columnName is not empty
                const headerDiv = document.createElement('div');
                headerDiv.className = 'header-column';
                headerDiv.textContent = columnName;
                headerRow.appendChild(headerDiv);
            }
        });
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

                header.innerHTML = '';
                header.appendChild(input);
                input.focus();

                input.addEventListener('blur', function() {
                    saveColumns();
                });

                input.addEventListener('keydown', function (event) {
                    if (event.key === 'Enter') {
                        saveColumns();
                    }
                });
            });
        });
    }

    function saveColumns() {
        const columns = Array.from(headerRow.querySelectorAll('.header-column')).map(header => {
            // Retrieve the text content from the input field if it exists
            if (header.querySelector('input')) {
                return header.querySelector('input').value.trim() || 'Untitled';
            } else {
                return header.textContent.trim() || 'Untitled';
            }
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
                // Reload columns after saving
                loadColumns();
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
    </script>
@endpush

@section('content')

    <div class="container" data-call-id="{{ $call_id }}">

            <div class="panel-body bg-gray-800 text-white">
                <h1 style="text-transform: uppercase;">{{ $callnum }} {{ $nature }} - {{ $address }} -
                    {{ $city }}/{{ $zone }}</h1>
                <!-- BEGIN row -->
                <div class="row" style="margin-left: 0; margin-right: 0;">
                    <!-- BEGIN col-9 for the map -->
                    <div id="map" class="col-xl-9 col-md-12" style="height: 250px;"></div>
                    <!-- END col-9 -->

                    <!-- BEGIN col-3 for the timer -->
                    <div class="col-xl-3 col-md-6">
                        <div class="widget widget-stats bg-red">
                            <div class="stats-icon"></div>
                            <div class="stats-info" style="text-align: center;">
                                <p id="timer" style="font-size: 40px; font-weight: bold;">00:00:00</p>
                            </div>
                            <div class="stats-link" style="text-align: center;">
                                <a href="javascript:;" id="reset-timer">
                                    <center>Reset PAR</center>
                                </a>
                            </div>
                        </div>
                        <div class="form-group mt-3" style="text-align: center;">
                            <label for="incident-type-dropdown">Incident Type</label>
                            <select class="form-control" id="incident-type-dropdown">
                                <option value="Structure Fire">Structure Fire</option>
                                <option value="Brush Fire">Brush Fire</option>
                                <option value="Other Fire">Other Fire</option>
                                <option value="Medical">Medical</option>
                                <option value="MCI">MCI</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <!-- END col-3 -->
                </div>
                <!-- END row -->
            </div>
        <!-- BEGIN panel -->
        <div class="panel panel-inverse" data-sortable-id="ui-widget-18">
            <div class="panel-heading">
                <h4 class="panel-title">Unit Assignments</h4>
            </div>
            <div class="panel-body bg-gray-800 text-white">
                <!-- Header -->
                <div class="header">
                    <div class="header-column">Units</div>
                    <div class="header-column">IC</div>
                    <div class="header-column">FA</div>
                    <div class="header-column">SEARCH</div>
                    <div class="header-column">VENT</div>
                    <div class="header-column">RIT</div>
                    <div class="header-column">MED</div>
                    <div class="header-column">DRONE</div>
                    <div class="header-column">DIV A</div>
                    <div class="header-column">DIV B</div>
                </div>

                <!-- Columns (Units + Assignments) -->
                <div class="assignments-columns" id="assignments-columns">
                    <!-- Units Column -->
                    <div class="column available-units">
                        <div id="unassigned" class="flex flex-wrap gap-2">
                            @foreach ($units as $unit)
                                <div class="box" data-unit-name="{{ $unit['unit'] }}">
                                    <div class="unit-header">
                                        <span>{{ $unit['unit'] }}</span>
                                        <small>{{ $unit['status'] }}</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Assignment Columns will be dynamically added here -->
                </div>
            </div>
            <div class="hljs-wrapper">
                <pre><code class="html" data-url="/assets/data/ui-widget-boxes/code-18.json"></code></pre>
            </div>
        </div>
        <!-- END panel -->
        <!-- BEGIN panel -->
        <div class="panel panel-inverse" data-sortable-id="ui-widget-18">
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
                <h4>{!! str_replace(['{', '}'], '', $comments) !!}</h4>
            </div>
            <div class="hljs-wrapper">
                <pre><code class="html" data-url="/assets/data/ui-widget-boxes/code-18.json"></code></pre>
            </div>
        </div>
        <!-- END panel -->
    </div>
@endsection
