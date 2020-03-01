<tr>
    <td></td>
    <td>Total</td>
    <td>{{ $report->sum('hra') }}</td>
    <td>{{ $report->sum('total_salary') }}</td>
    <td>{{ $report->sum('lic') }}</td>
    <td>{{ $report->sum('it') }}</td>
    <td>{{ $report->sum($type) }}</td>
    <td>{{ $report->sum('gr_ins') }}</td>
</tr>
<tr>
    <td></td>
    <td>Arriear D.A. @if($pay = $arriear->pluck('pay')->unique()->implode(',')) ({{ $pay }}) @endif</td>
    <td></td>
    <td>{{ $arriear->sum('da') }}</td>
    <td></td>
    <td>{{ $arriear->sum('da_it') }}</td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td></td>
    <td>Other Arriears</td>
    <td></td>
    <td>{{ $arriear->sum('other') }}</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td></td>
    <td>Bonus</td>
    <td></td>
    <td>{{ $arriear->sum('bonus') }}</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td></td>
    <td>Grand Total</td>
    <td>{{ $report->sum('hra') }}</td>
    <td>{{ $report->sum('total_salary') 
    + $arriear->sum('da') 
    + $arriear->sum('bonus') 
    + $arriear->sum('other') }}</td>
    <td>{{ $report->sum('lic') }}</td>
    <td>{{ $report->sum('it')
    + $arriear->sum('da_it') }}</td>
    <td>{{ $report->sum($type) }}</td>
    <td>{{ $report->sum('gr_ins') }}</td>
</tr>