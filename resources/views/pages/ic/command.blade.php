@extends('layouts.default')

@section('title', 'IC')

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons-core.min.css" rel="stylesheet">
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
        document.addEventListener("DOMContentLoaded", function() {
            mapboxgl.accessToken =
                'pk.eyJ1IjoibGhheW5pZSIsImEiOiJjbGQzbG80b3cwams3M3BqcjJ1YjZjZTVhIn0.OhMTetZePiPzigNNL-yhyQ';
            var latitude = @json($latitude);
            var longitude = @json($longitude);

            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/lhaynie/cleopgxcc000f01mq65j5rfiw',
                center: [longitude, latitude],
                zoom: 17
            });

            var el = document.createElement('div');
            el.style.width = '30px';
            el.style.height = '30px';
            el.style.backgroundColor = 'red';
            el.style.borderRadius = '50%';
            el.style.border = '2px solid white';

            new mapboxgl.Marker(el)
                .setLngLat([longitude, latitude])
                .addTo(map);
        });
    </script>
@endpush

@section('content')

    <div class="container" data-call-id="{{ $call_id }}">
        <!-- BEGIN panel -->
        <div class="panel panel-inverse" data-sortable-id="ui-widget-18">
            <div class="panel-heading">
                <h4 class="panel-title">Incident Details</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body bg-gray-800 text-white">
                <h1 style="text-transform: uppercase;">{{ $callnum }} {{ $nature }} - {{ $address }} -
                    {{ $city }}/{{ $zone }}</h1>
                <!-- BEGIN row -->
                <div class="row" style="margin-left: 0; margin-right: 0;">
                    <!-- BEGIN col-9 for the map -->
                    <div id="map" class="col-xl-9 col-md-12" style="height: 300px;"></div>
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
            <div class="hljs-wrapper">
                <pre><code class="html" data-url="/assets/data/ui-widget-boxes/code-18.json"></code></pre>
            </div>
        </div>
        <!-- END panel -->
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
