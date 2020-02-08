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
                        <div class="row col-sm-12">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>TEACHER/EMPLOYEE'S NAME & DESIGNATION</label>
                                    <input class="form-control" type="text" id="employee_name" name="employee_name" value="{{ $empData['employee_name'] }}" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>D.O.B</label>
                                    <input class="form-control" type="text" id="dob" name="dob" value="{{ $empData['dob'] }}" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>DATE OF APPTT.</label>
                                    <input class="form-control" type="text" id="date_of_apptt" name="date_of_apptt" value="{{ $empData['date_of_apptt'] }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row col-sm-12">                             
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>DATE OF INCR.</label>
                                    <input class="form-control" type="text" id="date_of_incr" name="date_of_incr" value="{{ $empData['date_of_incr'] }}" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>PAY BAND / LEVEL</label>
                                    <input class="form-control" type="text" id="pay_band_level" name="pay_band_level" value="{{ $empData['pay_band_level'] }}" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>PAY</label>
                                    <input class="form-control" type="text" id="pay" name="pay" value="{{ $empData['pay'] }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row col-sm-12">                                 
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>GRADE PAY</label>
                                    <input class="form-control" type="text" id="grade_pay" name="grade_pay" value="{{ $empData['grade_pay'] }}" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>TOTAL</label>
                                    <input class="form-control" type="text" id="total" name="total" value="{{ $empData['total'] }}" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>D.A (17%)</label>
                                    <input class="form-control" type="text" id="da_17" name="da_17" value="{{ $empData['da_17'] }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row col-sm-12">                             
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>H.A.</label>
                                    <input class="form-control" type="text" id="ha" name="ha" value="{{ $empData['ha'] }}" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>H.R.A</label>
                                    <input class="form-control" type="text" id="hra" name="hra" value="{{ $empData['hra'] }}" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>C.C.A</label>
                                    <input class="form-control" type="text" id="cca" name="cca" value="{{ $empData['cca'] }}" />
                                </div>
                            </div>
                        </div>  
                        <div class="row col-sm-12">                                  
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>TOTAL SALARY</label>
                                    <input class="form-control" type="text" id="total_salary" name="total_salary" value="{{ $empData['total_salary'] }}" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Basic+ D.A.</label>
                                    <input class="form-control" type="text" id="basic_da" name="basic_da" value="{{ $empData['basic_da'] }}" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>I.T</label>
                                    <input class="form-control" type="text" id="it" name="it" value="{{ $empData['it'] }}" />
                                </div>
                            </div>
                        </div>  
                        <div class="row col-sm-12">                                  
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>N.P.S</label>
                                    <input class="form-control" type="text" id="nps" name="nps" value="{{ $empData['nps'] }}" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>CO-OPERATIVE LOAN</label>
                                    <input class="form-control" type="text" id="co_operative_loan" name="co_operative_loan" value="{{ $empData['co_operative_loan'] }}" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>L.I.C</label>
                                    <input class="form-control" type="text" id="lic" name="lic" value="{{ $empData['lic'] }}" />
                                </div>
                            </div>
                        </div>   
                        <div class="row col-sm-12">                                 
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>GR.INS</label>
                                    <input class="form-control" type="text" id="gr_ins" name="gr_ins" value="{{ $empData['gr_ins'] }}" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>TOTAL DEDU.</label>
                                    <input class="form-control" type="text" id="total_dedu" name="total_dedu" value="{{ $empData['total_dedu'] }}" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>TOTAL PAYMENT</label>
                                    <input class="form-control" type="text" id="total_payment" name="total_payment" value="{{ $empData['total_payment'] }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row col-sm-12">                                    
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>N.P.S. GOVT. SHARE</label>
                                    <input class="form-control" type="text" id="nps_govt_share" name="nps_govt_share" value="{{ $empData['nps_govt_share'] }}" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Employee status</label>
                                    <label>Working</label><input class="form-control" type="radio" id="emp" name="emp_status" />
                                <label>Retired</label><input class="form-control" type="radio" id="emp" name="emp_status" />
                                <label>Retired Working</label><input class="form-control" type="radio" id="emp" name="emp_status" />
                                </div>
                                
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <label>Active</label><input class="form-control" type="radio" id="status" name="status" />
                                </div>
                                <label>In Active</label><input class="form-control" type="radio" id="status" name="status" />
                            </div>
                        </div> 
                        @endif
                        <button type="button" id="update" class="btn btn-primary btn-sm">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
