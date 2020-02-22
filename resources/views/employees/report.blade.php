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
                    <form method="GET" class="form-horizontal">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label">Session Start</label>
                                    <select name="session_start" class="form-control">
                                        <option value="">Select</option>
                                        @for ($i = 2000; $i < date("Y") + 1; $i++)
                                        <option value="{{ $i }}" @if($session_start == $i) selected @endif>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label">Session End</label>
                                    <select name="session_end" class="form-control">
                                        <option value="">Select</option>
                                        @for ($i = 2000; $i <= date("Y") + 1; $i++)
                                        <option value="{{ $i }}" @if($session_end == $i) selected @endif>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-sm form-control">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="list-tab-outer d-flex justify-content-between">
                        <ul id="myTab4" role="tablist" class="nav nav-tabs card-tabs no-b r-0 align-self-end">
                            <li class="nav-item">
                                <a class="nav-link active show" id="tab1" data-toggle="tab" href="#gpf" role="tab"
                                    aria-controls="tab1" aria-expanded="true" aria-selected="true" title="G.P.F">G.P.F Report</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab2" data-toggle="tab" href="#nps" role="tab" aria-controls="tab2"
                                    aria-selected="false" title="N.P.S">N.P.S Report</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="gpf" role="tabpanel" aria-labelledby="gpf">
                            <div class="box-body no-padding border dataTable">
                                <div class="col-sm-12 table-responsive">
                                    <table class="table table-bordered table-hover data-tables" data-options='{"searching":false}'>
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
                                            @foreach ($tax_report['gpf'] as $key => $tax)   
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
                                        <tfoot>
                                            @include('employees.partials.extra_reports', [
                                                'report' => collect($tax_report['gpf']),
                                                'type' => 'gpf'
                                            ])
                                        </tfoot>
                                    </table>
                                </div>
                                @foreach ($employees['gpf'] as $key => $employee)
                                @include('employees.partials.single_report', [
                                    'employee' => $employee,
                                    'type' => 'gpf'
                                ])
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nps" role="tabpanel" aria-labelledby="nps">
                            <div class="box-body no-padding border dataTable">
                                <div class="col-sm-12 table-responsive">
                                    <table class="table table-bordered table-hover data-tables" data-options='{"searching":false}'>
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Month</th>
                                                <th>H.R.A</th>
                                                <th>Total Salary</th>
                                                <th>L.I.C</th>
                                                <th>I.T</th>
                                                <th>N.P.S./P.P.F</th>
                                                <th>Gr.Ins</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tax_report['nps'] as $key => $tax)   
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $tax['month'] }}/{{ $tax['year'] }}</td>
                                                <td>{{ $tax['hra'] }}</td>
                                                <td>{{ $tax['total_salary'] }}</td>
                                                <td>{{ $tax['lic'] }}</td>
                                                <td>{{ $tax['it'] }}</td>
                                                <td>{{ $tax['nps'] }}</td>
                                                <td>{{ $tax['gr_ins'] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            @include('employees.partials.extra_reports', [
                                                'report' => collect($tax_report['nps']),
                                                'type' => 'nps'
                                            ])
                                        </tfoot>
                                    </table>
                                </div>
                                @foreach ($employees['nps'] as $key => $employee)
                                @include('employees.partials.single_report', [
                                    'employee' => $employee,
                                    'type' => 'nps'
                                ])
                                @endforeach
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection