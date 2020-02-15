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
                        @if(isset($empData) && $empData->count())
                        <div class="row">
                            <div class="col-sm-6">
                                <label>EMPLOYEE'S NAME</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" id="employee_name" name="employee_name" value="{{ $empData['employee_name'] }}" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>PAY BAND / LEVEL</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" id="pay_band_level" name="pay_band_level" value="{{ $empData['pay_band_level'] }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label>EMPLOYEE STATUS</label>
                                <div class="form-group">
                                    <input type="radio" id="working" />
                                    <label>Working</label>
                                    <input type="radio" id="retired" />
                                    <label>Retired</label>
                                    <input type="radio" id="ret_working" />
                                    <label>Retired Working</label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label>STATUS</label>
                                <div class="form-group">
                                    <input type="radio" id="active" />
                                    <label>Active</label>
                                    <input type="radio" id="in_active" />
                                    <label>In Active</label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                <button type="button" id="update" class="btn btn-primary form-control">Update</button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="year" value="{{ $empData['year'] }}" />
                        <input type="hidden" id="month" value="{{ $empData['month'] }}" />
                        @endif
                    </form>
                    <div id="table_data" class="row table-responsive">
                        <div class="row text-center"> 
                            <div class="col-sm-12">
                                <button type="button" id="add" class="btn btn-primary btn-sm">Add Salary</button>
                            </div>
                        </div>
                        <table id="table" class="table table-stripped table-bordered data-tables">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>YEAR</th>
                                    <th>MONTH</th>
                                    <th>DOB</th>
                                    <th>DATE OF APPOINTMENT</th>
                                    <th>DATE OF INCREAMENT</th>
                                    <th>PAY BAND / LEVEL</th>
                                    <th>GRADE PAY</th>
                                    <th>TOTAL</th>
                                    <th>D.A (17%)</th>
                                    <th>H.A.</th>
                                    <th>H.R.A.</th>
                                    <th>C.C.A</th>
                                    <th>TOTAL SALARY</th>
                                    <th>Basic+ D.A.</th>
                                    <th>I.T</th>
                                    <th>N.P.S</th>
                                    <th>CO-OPERATIVE LOAN</th>
                                    <th>L.I.C</th>
                                    <th>GR.INS</th>
                                    <th>TOTAL DEDU.</th>
                                    <th>GPF LOAN</th>
                                    <th>TOTAL PAYMENT</th>
                                    <th>N.P.S. GOVT. SHARE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($empData['data'] as $emp)    
                                <tr>
                                    <td>
                                        <button class="edit btn btn-sm btn-success" id="edit_1" data-id="{{ $emp['id'] }}" title="Edit" data-toggle="modal" data-target="#modalLoginForm">Edit</button>
                                    </td>
                                    <td>{{ $emp['year'] }}</td>
                                    <td>{{ $emp['month'] }}</td>
                                    <td>{{ $emp['dob'] }}</td>
                                    <td>{{ $emp['date_of_apptt'] }}</td>
                                    <td>{{ $emp['date_of_incr'] }}</td>
                                    <td>{{ $emp['pay'] }}</td>
                                    <td>{{ $emp['grade_pay'] }}</td>
                                    <td>{{ $emp['dototalb'] }}</td>
                                    <td>{{ $emp['da_17'] }}</td>
                                    <td>{{ $emp['ha'] }}</td>
                                    <td>{{ $emp['hra'] }}</td>
                                    <td>{{ $emp['cca'] }}</td>
                                    <td>{{ $emp['total_salary'] }}</td>
                                    <td>{{ $emp['basic_da'] }}</td>
                                    <td>{{ $emp['it'] }}</td>
                                    <td>{{ $emp['nps'] }}</td>
                                    <td>{{ $emp['co_operative_loan'] }}</td>
                                    <td>{{ $emp['lic'] }}</td>
                                    <td>{{ $emp['gr_ins'] }}</td>
                                    <td>{{ $emp['total_dedu'] }}</td>
                                    <td>{{ $emp['gpf_loan'] }}</td>
                                    <td>{{ $emp['total_payment'] }}</td>
                                    <td>{{ $emp['nps_govt_share'] }}</td>
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
<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Employee</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>            
            <div id="modaldata"></div>
        </div>
    </div>
  </div>
</div>
@endsection
@push('script')
    <script>
        $(document).on('click', '.edit', function() {            
            $.ajax({
                url: "{{ url('employee/getData') }}",
                type:'post',
                data: {
                    id:$(this).data('id'),
                    _token: "{{ csrf_token() }}"
                },
                success: function(resp) {
                    $('#modaldata').html(resp);
                },
                error: function() {
                    $('#modaldata').html('<p>Unable to get data</p>');
                }
            })
        })
    </script>
@endpush