@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Employee</div>
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
                                <tr>
                                    <td>
                                        <button class="edit" id="edit_1" data-id="1"  data-month="02" data-year="2020" title="Edit" data-toggle="modal" data-target="#modalLoginForm">Edit</button>
                                    </td>
                                    <td>2020</td>
                                    <td>01</td>
                                    <td>{{ $empData['data'][0]['dob'] }}</td>
                                    <td>{{ $empData['data'][0]['date_of_apptt'] }}</td>
                                    <td>{{ $empData['data'][0]['date_of_incr'] }}</td>
                                    <td>{{ $empData['data'][0]['pay'] }}</td>
                                    <td>{{ $empData['data'][0]['grade_pay'] }}</td>
                                    <td>{{ $empData['data'][0]['dototalb'] }}</td>
                                    <td>{{ $empData['data'][0]['da_17'] }}</td>
                                    <td>{{ $empData['data'][0]['ha'] }}</td>
                                    <td>{{ $empData['data'][0]['hra'] }}</td>
                                    <td>{{ $empData['data'][0]['cca'] }}</td>
                                    <td>{{ $empData['data'][0]['total_salary'] }}</td>
                                    <td>{{ $empData['data'][0]['basic_da'] }}</td>
                                    <td>{{ $empData['data'][0]['it'] }}</td>
                                    <td>{{ $empData['data'][0]['nps'] }}</td>
                                    <td>{{ $empData['data'][0]['co_operative_loan'] }}</td>
                                    <td>{{ $empData['data'][0]['lic'] }}</td>
                                    <td>{{ $empData['data'][0]['gr_ins'] }}</td>
                                    <td>{{ $empData['data'][0]['total_dedu'] }}</td>
                                    <td>{{ $empData['data'][0]['gpf_loan'] }}</td>
                                    <td>{{ $empData['data'][0]['total_payment'] }}</td>
                                    <td>{{ $empData['data'][0]['nps_govt_share'] }}</td>
                                </tr>
                            <tbody>
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
                url: "{{ url('employee/edit') }}",
                type:'post',
                data: {
                    id:$(this).data('id'),
                    month:$(this).data('month'),
                    year:$(this).data('year'),
                    _token: "{{ csrf_token() }}"
                },

                success: function(resp) {
                    $('#modaldata').html(resp);
                },

                error: function() {

                }
            })

        })
    </script>
@endpush