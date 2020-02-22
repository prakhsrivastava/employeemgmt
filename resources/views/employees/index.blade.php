@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Employee Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row">
                        <form method="post" id="import_xls" action="{{ route('emp.import') }}" enctype="multipart/form-data" class="col-sm-12">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Excel</label>
                                        <input type="file" name="xl_file" class="form-control"/>
                                    </div>                                    
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Month</label>
                                        <div class="input-group">
                                            <input id="month" type="text" class="date-time-picker form-control date" name="month" data-options='{"timepicker":false, "format":"d/m/Y"}' autocomplete="off" readonly>
                                            <span class="input-group-append">
                                                <span class="input-group-text add-on white">
                                                <i class="icon-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>&nbsp;</label>
                                    <button type="button" id="import" class="btn btn-primary btn-sm btn-block">Import</button>
                                </div>
                            </div>                                
                        </form>
                    </div>
                    <div class="row text-center"> 
                        <div class="col-sm-12">
                            <button type="button" id="report" class="btn btn-success btn-sm" onclick="window.location.href='{{ route('emp.report') }}'">Tax Report</button>
                        </div>
                    </div>
                    <br/>
                    <div class="list-tab-outer d-flex justify-content-between">
                        <ul id="myTab4" role="tablist" class="nav nav-tabs card-tabs no-b r-0 align-self-end">
                            <li class="nav-item">
                                <a class="nav-link active show" id="tab1" data-toggle="tab" href="#working" role="tab" aria-controls="tab1" aria-expanded="true" aria-selected="true" title="Working">Working</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab2" data-toggle="tab" href="#retired" role="tab" aria-controls="tab2" aria-selected="false" title="Retired">Retired</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab3" data-toggle="tab" href="#retired_working" role="tab" aria-controls="tab3" aria-selected="false" title="Retired Working">Retired Working</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="working" role="tabpanel" aria-labelledby="working">
                            @include('employees.partials.table', [
                                'employees' => collect($employees)->reject(function ($employee) {
                                    if ($employee->emp_status != 'working') {
                                        return true;
                                    }
                                })->toArray()
                            ])
                        </div>
                        <div class="tab-pane fade" id="retired" role="tabpanel" aria-labelledby="retired">
                            @include('employees.partials.table', [
                                'employees' => collect($employees)->reject(function ($employee) {
                                    if ($employee->emp_status != 'retired') {
                                        return true;
                                    }
                                })->toArray()
                            ])
                        </div>
                        <div class="tab-pane fade" id="retired_working" role="tabpanel" aria-labelledby="retired_working">
                            @include('employees.partials.table', [
                                'employees' => collect($employees)->reject(function ($employee) {
                                    if ($employee->emp_status != 'retired_working') {
                                        return true;
                                    }
                                })->toArray()
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '#import', function () {
            var flag = 1;
            if (!$('[name="xl_file"]').val()) {
                flag = 0;
                alert('Please select the excel to import.');
            }

            if (!$('[name="month"]').val()) {
                flag = 0;
                alert('Please select the month to import.');
            }

            if (flag) {
                $('#import_xls').submit();
            }
        });
    });

    function confirmDialog(message, callback) {
        if (confirm(message)) {
            callback();
        }
    }
</script>
@endpush
