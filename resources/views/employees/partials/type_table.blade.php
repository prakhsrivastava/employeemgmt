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
                    @if ($type == 'gpf')
                    <th>G.P.F.</th>
                    @else
                    <th>N.P.S./P.P.F</th>
                    @endif
                    <th>Gr.Ins</th>
                </tr>
            </thead>
            <tbody>
                @foreach (collect($reports[$type])->except('arriear') as $key => $tax)   
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $tax['month'] }}/{{ $tax['year'] }}</td>
                    <td>{{ $tax['hra'] }}</td>
                    <td>{{ $tax['total_salary'] }}</td>
                    <td>{{ $tax['lic'] }}</td>
                    <td>{{ $tax['it'] }}</td>
                    <td>{{ $tax[$type] }}</td>
                    <td>{{ $tax['gr_ins'] }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                @include('employees.partials.extra_reports', [
                    'report' => collect($reports[$type]),
                    'arriear' => collect($reports[$type]['arriear']),
                    'type' => $type
                ])
            </tfoot>
        </table>
    </div>
    @foreach ($employees[$type] as $key => $employee)
    @include('employees.partials.single_report', [
        'employee' => $employee,
        'type' => $type
    ])
    @endforeach
</div>