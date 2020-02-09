@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Tax Report
                    <div class="text-right">
                        <a href="{{ route('emp.index') }}" class="link-text">Back to Dashboard</a>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table class="table table-bordered table-hover data-tables">
                                <thead>
                                    <tr>
                                        <th>S. No.</th>
                                        <th>Month</th>
                                        <th>H.R.A</th>
                                        <th>Total Salary</th>
                                        <th>L.I.C</th>
                                        <th>I.T</th>
                                        <th>G.P.F.</th>
                                        <th>Gr.Ins</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tax_report as $key => $tax)   
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $tax['month'] }}/{{ $tax['year'] }}</td>
                                        <td>{{ $tax['hra'] }}</td>
                                        <td>{{ $tax['total_salary'] }}</td>
                                        <td>{{ $tax['lic'] }}</td>
                                        <td>{{ $tax['it'] }}</td>
                                        <td>{{ $tax['gpf'] }}</td>
                                        <td>{{ $tax['gr_ins'] }}</td>
                                    </tr>
                                    @endforeach                                    
                                </tbody>
                            </table>                            
                        </div>
                        @foreach ($employees as $key => $employee)
                        <div class="col-sm-12 table-responsive">
                            <hr/>
                            <p class="text-center text-danger"><strong>{{ $employee->employee_name }}</strong></p> 
                            <table class="table table-bordered table-hover data-tables">
                                <thead>
                                    <tr>
                                        <th>S. No.</th>
                                        <th>Month</th>
                                        <th>H.R.A</th>
                                        <th>Total Salary</th>
                                        <th>L.I.C</th>
                                        <th>I.T</th>
                                        <th>G.P.F.</th>
                                        <th>Gr.Ins</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employee->data as $key => $data)   
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $data['month'] }}/{{ $data['year'] }}</td>
                                        <td>{{ $data['hra'] }}</td>
                                        <td>{{ $data['total_salary'] }}</td>
                                        <td>{{ $data['lic'] }}</td>
                                        <td>{{ $data['it'] }}</td>
                                        <td>{{ $data['gpf'] }}</td>
                                        <td>{{ $data['gr_ins'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection