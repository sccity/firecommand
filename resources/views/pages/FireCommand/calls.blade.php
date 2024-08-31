@extends('layouts.default')

@section('title', 'Active Calls')

@push('css')
    <link href="/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <style>
        #activeCallsTable tbody tr:hover,
        #activeCallsTable tbody tr:hover td:nth-child(1) {
            background-color: #34495e !important;
            color: #ffffff !important;
        }

        #activeCallsTable tbody tr,
        #activeCallsTable tbody td {
            font-size: 16px !important;
            padding: 15px 8px !important;
        }

        #loader {
            display: none !important;
        }

        .pace,
        .pace-inactive,
        .pace-active {
            display: none !important;
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
    <script src="/assets/plugins/datatables.net/js/dataTables.min.js"></script>
    <script src="/assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#activeCallsTable').DataTable({
                paging: false,
                info: false,
                searching: false,
                ordering: false,
            });

            $('#activeCallsTable tbody').on('click', 'tr', function() {
                var callId = $(this).data('call-id');
                window.location.href = '/FireCommand/command?callid=' + callId;
            });

            function fetchActiveCalls() {
                $.ajax({
                    url: '{{ route('fc-calls') }}',
                    type: 'GET',
                    success: function(data) {
                        updateActiveCallsTable(data.calls);
                    },
                    error: function() {
                        console.log('Failed to fetch active calls data');
                    }
                });
            }

            function updateActiveCallsTable(calls) {
                var tbody = $('#activeCallsTable tbody');
                tbody.empty();
                if (calls.length > 0) {
                    $.each(calls, function(index, call) {
                        var row = '<tr data-call-id="' + call.call_id + '">' +
                            '<td>' + call.agency + '</td>' +
                            '<td>' + call.nature + '</td>' +
                            '<td>' + call.address + '</td>' +
                            '<td>' + call.status + '</td>' +
                            '<td>' + call.status_time + '</td>' +
                            '</tr>';
                        tbody.append(row);
                    });
                } else {
                    tbody.append('<tr><td colspan="5">There are currently no active calls.</td></tr>');
                }
                $('#activeCallsTable').DataTable().draw();
            }

            fetchActiveCalls();
            setInterval(fetchActiveCalls, 5000);
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
            @if (!empty($calls))
                <table id="activeCallsTable" class="table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Agency</th>
                            <th>Nature</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($calls as $call)
                            <tr data-call-id="{{ $call['call_id'] }}">
                                <td>{{ $call['agency'] }}</td>
                                <td>{{ $call['nature'] }}</td>
                                <td>{{ $call['address'] }}</td>
                                <td>{{ $call['status'] }}</td>
                                <td>{{ $call['status_time'] }}</td>
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
