@extends('layouts.default')

@section('title', 'IC')

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons-core.min.css" rel="stylesheet">
    <link href="{{ asset('css/fc-command.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/interact.js/1.0.2/interact.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
    <script src="{{ asset('js/FireCommand/ic-par.js') }}"></script>
    <script src="{{ asset('js/FireCommand/ic-interaction.js') }}"></script>
    <script src="{{ asset('js/FireCommand/ic-updatedata.js') }}"></script>
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
                    <div class="header-column">RIC</div>
                    <div class="header-column">MED</div>
                    <div class="header-column">STAGE</div>
                    <div class="header-column">DIV A</div>
                    <div class="header-column">DIV B</div>
                </div>

                <!-- Columns (Units + Assignments) -->
                <div class="assignments-columns">
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
                {!! str_replace(['{', '}'], '', $comments) !!}
            </div>
            <div class="hljs-wrapper">
                <pre><code class="html" data-url="/assets/data/ui-widget-boxes/code-18.json"></code></pre>
            </div>
        </div>
        <!-- END panel -->
    </div>
@endsection
