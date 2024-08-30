@extends('layouts.default')

@section('title', 'Active Calls')

@push('css')
<link href="/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
<link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
<link href="/assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<style>
    /* Hover effect for rows including the Agency column */
    #activeCallsTable tbody tr:hover,
    #activeCallsTable tbody tr:hover td:nth-child(1) {
        background-color: #34495e !important; /* Slightly lighter background on hover */
        color: #ffffff !important; /* Ensure text stays readable on hover */
    }
    #activeCallsTable tbody tr,
    #activeCallsTable tbody td {
        font-size: 16px !important;
        padding: 15px 8px !important;
    }
</style>
@endpush

@push('scripts')
<script src="/assets/plugins/flot/source/jquery.canvaswrapper.js"></script>
<script src="/assets/plugins/flot/source/jquery.colorhelpers.js"></script>
<script src="/assets/plugins/flot/source/jquery.flot.js"></script>
<script src="/assets/plugins/flot/source/jquery.flot.saturated.js"></script>
<script src="/assets/plugins/flot/source/jquery.flot.browser.js"></script>
<script src="/assets/plugins/flot/source/jquery.flot.drawSeries.js"></script>
<script src="/assets/plugins/flot/source/jquery.flot.uiConstants.js"></script>
<script src="/assets/plugins/flot/source/jquery.flot.time.js"></script>
<script src="/assets/plugins/flot/source/jquery.flot.resize.js"></script>
<script src="/assets/plugins/flot/source/jquery.flot.pie.js"></script>
<script src="/assets/plugins/flot/source/jquery.flot.crosshair.js"></script>
<script src="/assets/plugins/flot/source/jquery.flot.categories.js"></script>
<script src="/assets/plugins/flot/source/jquery.flot.navigate.js"></script>
<script src="/assets/plugins/flot/source/jquery.flot.touchNavigate.js"></script>
<script src="/assets/plugins/flot/source/jquery.flot.hover.js"></script>
<script src="/assets/plugins/flot/source/jquery.flot.touch.js"></script>
<script src="/assets/plugins/flot/source/jquery.flot.selection.js"></script>
<script src="/assets/plugins/flot/source/jquery.flot.symbol.js"></script>
<script src="/assets/plugins/flot/source/jquery.flot.legend.js"></script>
<script src="/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="/assets/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
<script src="/assets/plugins/jvectormap-content/world-mill.js"></script>
<script src="/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
<script src="/assets/js/demo/dashboard.js"></script>
<script src="/assets/js/clock.js"></script>
<script src="/assets/plugins/datatables.net/js/dataTables.min.js"></script>
<script src="/assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#activeCallsTable').DataTable({
            paging: true, 
            info: false,
            searching: false,
        });

        $('#activeCallsTable tbody tr').on('click', function() {
            var callId = $(this).data('call-id');
            window.location.href = '/ic/' + callId;
        });
    });
</script>
@endpush

@section('content')
<!-- begin page-header -->
<h1 class="page-header"><small></small></h1>
<!-- end page-header -->
<!-- begin panel -->
<div class="panel panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title">Active Calls</h4>
    </div>
    <div class="panel-body">
        @if(!empty($activeCalls))
        <table id="activeCallsTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Agency</th>
                    <th>Nature</th>
                    <th>Status</th>
                    <th>Address</th>
                    <th>Dispatched</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($activeCalls as $call)
                    <tr data-call-id="{{ $call['call_id'] }}"> <!-- Add data-call-id attribute -->
                        <td>{{ $call['agency'] }}</td>
                        <td>{{ $call['nature'] }}</td>
                        <td>{{ $call['status'] }}</td>
                        <td>{{ $call['address'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($call['date'])->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>There are currently no active calls.</p>
        @endif
    </div>
</div>
<!-- end panel -->
@endsection