<div class="col-sm-12 table-responsive">
    <hr/>
    <p class="text-center text-danger">Name: <strong>{{ $employee['employee_name'] }}</strong></p>
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
            @foreach ($employee['data'] as $key => $data)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $data['month'] }}/{{ $data['year'] }}</td>
                <td>{{ $data['hra'] }}</td>
                <td>{{ $data['total_salary'] }}</td>
                <td>{{ $data['lic'] }}</td>
                <td>{{ $data['it'] }}</td>
                <?php
                    $type_value = '-';
                    if (!isset($data['nps']) && $type == 'gpf'):
                        $type_value = $data['gpf'];
                    elseif (isset($data['nps']) && $type == 'nps'):
                        $type_value = $data['nps'];
                    endif;
                ?>
                <td>{{ $type_value }}</td>
                <td>{{ $data['gr_ins'] }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            @include('employees.partials.extra_reports', [
                'report' => collect($employee['data']),
                'arriear' => collect($employee['arriear']),
                'type' => $type
            ])
        </tfoot>
    </table>
</div>