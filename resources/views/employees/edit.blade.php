@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Edit Employee
                    <div class="text-right">
                        <a href="{{ route('emp.index') }}" class="link-text">Back to Dashboard</a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label">EMPLOYEE'S NAME</label>
                                    <input class="form-control" type="text" id="employee_name" name="employee_name" value="{{ $empData['employee_name'] }}" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label">Designation</label>
                                    <input class="form-control" type="text" id="designation" name="designation" value="{{ $empData['designation'] }}" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label">PAY BAND / LEVEL</label>
                                    <input class="form-control" type="text" id="pay_band_level" name="pay_band_level" value="{{ $empData['pay_band_level'] }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label class="form-label">EMPLOYEE STATUS</label>
                                    <div class="radio-box">
                                        <span class="cust-radio">
                                            <input type="radio" id="working" name="emp_status" @if($empData['emp_status'] == 'working') checked @endif value="working"/>
                                            <i class="dot"></i>
                                        </span>
                                        <label for="working">Working</label>
                                        <span class="cust-radio">
                                            <input type="radio" id="retired" name="emp_status" @if($empData['emp_status'] == 'retired') checked @endif value="retired"/>
                                            <i class="dot"></i>
                                        </span>
                                        <label for="retired">Retired</label>
                                        <span class="cust-radio">
                                            <input type="radio" id="ret_working" name="emp_status" @if($empData['emp_status'] == 'retired_working') checked @endif value="retired_working"/>
                                            <i class="dot"></i>
                                        </span>
                                        <label for="ret_working">Retired Working</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label">STATUS</label>
                                    <div class="radio-box">
                                        <span class="cust-radio">
                                            <input type="radio" id="active" name="status" @if($empData['status']) checked @endif value="1"/>
                                            <i class="dot"></i>
                                        </span>
                                        <label for="active">Active</label>
                                        <span class="cust-radio">
                                            <input type="radio" id="inactive" name="status" @if(!$empData['status']) checked @endif value="0"/>
                                            <i class="dot"></i>
                                        </span>
                                        <label for="inactive">Inactive</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-label">&nbsp;</label>
                                    <button type="submit" id="update" class="btn btn-primary form-control">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div id="table_data" class="row table-responsive">
                        <div class="row text-center"> 
                            <div class="col-sm-12">
                                <button type="button" id="add" class="btn btn-success btn-sm" data-toggle="modal" data-target="#extra_details">Add Arriears</button>
                                <button type="button" id="tax" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#report_details">Tax Report</button>
                            </div>
                        </div>
                        <table id="table" class="table table-stripped table-bordered data-tables">
                            <thead>
                                <tr>
                                    <th>YEAR</th>
                                    <th>MONTH</th>
                                    @foreach ($headers as $head) 
                                    <th>{{ $head }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($empData['data'] as $emp)   
                                <tr>
                                    <td>{{ $emp['year'] }}</td>
                                    <td>{{ $emp['month'] }}</td>
                                    @foreach ($headers as $slug => $head) 
                                    <td>{{ isset($emp->data[$slug]) ? $emp->data[$slug] : '' }}</td>
                                    @endforeach
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
<div class="modal fade" id="extra_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Arriears</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="{{ route('emp.add_arriear', [$empData['id']]) }}" id="add_arriear">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label">Session Start</label>
                                <select name="session_start" class="form-control" required>
                                    <option value="">Select</option>
                                    @for ($i = 2000; $i < date("Y") + 1; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label">Session End</label>
                                <select name="session_end" class="form-control" required>
                                    <option value="">Select</option>
                                    @for ($i = 2000; $i <= date("Y") + 1; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label">Arriear D.A.</label>
                                <input type="text" name="da" class="price form-control" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label">Other Arriear</label>
                                <input type="text" name="other" class="price form-control" required value="0" />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label">Bonus</label>
                                <input type="text" name="bonus" class="price form-control" required value="0" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn form-btn form-grey-btn mr-2" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="form-btn btn" id="save_arriears">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="report_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Report</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <?php
                    $type = 'gpf';
                    $employee = collect($empData)->only('employee_name');
                    $employee['data'] = collect($empData['data'])->pluck('data')
                        ->map(function ($array, $key) use($empData) {
                            return collect($array)->merge([
                                'year' => collect($empData['data'])->pluck('year')[$key],
                                'month' => collect($empData['data'])->pluck('month')[$key],
                            ])->toArray();
                        });
                    if ($employee['data']->sum('nps') > 0) {
                        $type = 'nps';
                    }
                ?>
                @include('employees.partials.single_report', [
                    'employee' => $employee,
                    'type' => $type
                ])
            </div>
            <div class="modal-footer">
                <button type="button" class="btn form-btn form-grey-btn mr-2" data-dismiss="modal">Cancel</button>
                <button type="button" class="form-btn btn" id="print">Print</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
</script>
@endpush