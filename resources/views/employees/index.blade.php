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
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table class="table table-bordered table-hover data-tables">
                                <thead>
                                    <tr>
                                        <th class="text-center">Actions</th>
                                        <th>S. No.</th>
                                        <th>Name</th>
                                        <th>Pay Band / Level</th>
                                        <th>Working Status</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)   
                                    <tr>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <form method="POST" action="{{ route('emp.delete', [$employee->id]) }}">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="confirmDialog('Are you sure ?', function (e) {
                                                        e.preventDefault();
                                                        $(this).closest('form').submit();
                                                    })">Delete</button>
                                                </form>
                                                <button type="button" class="btn btn-sm btn-warning" onclick="window.location.href='{{ route('emp.edit', [$employee->id]) }}'">Edit</button>
                                            </div>
                                        </td>
                                        <td>{{ $employee->id }}</td>
                                        <td>{{ $employee->employee_name }}</td>
                                        <td>{{ $employee->pay_band_level }}</td>
                                        <td>{{ $employee->emp_status }}</td>
                                        <td>{{ ($employee->status)?'Active':'Inactive' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
