<div class="modal-body">
    <form method="post" action="{{ url('employee/update') }}/{{ $empData->id }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if(isset($empData) && $empData->count())
        <div class="row col-sm-12">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>YEAR</label>
                    <input class="form-control" type="text" id="year" name="year" value="{{ (isset($empData['year']))?$empData['year']:'' }}" />
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>MONTH</label>
                    <input class="form-control" type="text" id="month" name="month" value="{{ (isset($empData['month']))?$empData['month']:'' }}" />
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>D.O.B</label>
                    <input class="form-control" type="text" id="dob" name="dob" value="{{ (isset($empData['dob']))?$empData['dob']:'' }}" />
                </div>
            </div>
        </div>
        <div class="row col-sm-12">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>DATE OF APPTT.</label>
                    <input class="form-control" type="text" id="date_of_apptt" name="date_of_apptt" value="{{ (isset($empData['date_of_apptt']))?$empData['date_of_apptt']:'' }}" />
                </div>
            </div>                      
            <div class="col-sm-4">
                <div class="form-group">
                    <label>DATE OF INCR.</label>
                    <input class="form-control" type="text" id="date_of_incr" name="date_of_incr" value="{{ (isset($empData['date_of_incr']))?$empData['date_of_incr']:'' }}" />
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>PAY</label>
                    <input class="form-control" type="text" id="pay" name="pay" value="{{ (isset($empData['pay']))?$empData['pay']:'' }}" />
                </div>
            </div>
        </div>
        <div class="row col-sm-12">                                 
            <div class="col-sm-4">
                <div class="form-group">
                    <label>GRADE PAY</label>
                    <input class="form-control" type="text" id="grade_pay" name="grade_pay" value="{{ (isset($empData['grade_pay']))?$empData['grade_pay']:'' }}" />
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>TOTAL</label>
                    <input class="form-control" type="text" id="total" name="total" value="{{ (isset($empData['total']))?$empData['total']:'' }}" />
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>D.A (17%)</label>
                    <input class="form-control" type="text" id="da_17" name="da_17" value="{{ (isset($empData['da_17']))?$empData['da_17']:'' }}" />
                </div>
            </div>
        </div>
        <div class="row col-sm-12">                             
            <div class="col-sm-4">
                <div class="form-group">
                    <label>H.A.</label>
                    <input class="form-control" type="text" id="ha" name="ha" value="{{ (isset($empData['ha']))?$empData['ha']:'' }}" />
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>H.R.A</label>
                    <input class="form-control" type="text" id="hra" name="hra" value="{{ (isset($empData['hra']))?$empData['hra']:'' }}" />
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>C.C.A</label>
                    <input class="form-control" type="text" id="cca" name="cca" value="{{ (isset($empData['cca']))?$empData['cca']:'' }}" />
                </div>
            </div>
        </div>  
        <div class="row col-sm-12">                                  
            <div class="col-sm-4">
                <div class="form-group">
                    <label>TOTAL SALARY</label>
                    <input class="form-control" type="text" id="total_salary" name="total_salary" value="{{ (isset($empData['total_salary']))?$empData['total_salary']:'' }}" />
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Basic+ D.A.</label>
                    <input class="form-control" type="text" id="basic_da" name="basic_da" value="{{(isset($empData['basic_da']))?$empData['basic_da']:'' }}" />
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>I.T</label>
                    <input class="form-control" type="text" id="it" name="it" value="{{ (isset($empData['it']))?$empData['it']:'' }}" />
                </div>
            </div>
        </div>  
        <div class="row col-sm-12">                                  
            <div class="col-sm-4">
                <div class="form-group">
                    <label>N.P.S</label>
                    <input class="form-control" type="text" id="nps" name="nps" value="{{ (isset($empData['nps']))?$empData['nps']:'' }}" />
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>CO-OPERATIVE LOAN</label>
                    <input class="form-control" type="text" id="co_operative_loan" name="co_operative_loan" value="{{ (isset($empData['co_operative_loan']))?$empData['co_operative_loan']:'' }}" />
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>L.I.C</label>
                    <input class="form-control" type="text" id="lic" name="lic" value="{{ (isset($empData['lic']))?$empData['lic']:'' }}" />
                </div>
            </div>
        </div>   
        <div class="row col-sm-12">                                 
            <div class="col-sm-4">
                <div class="form-group">
                    <label>GR.INS</label>
                    <input class="form-control" type="text" id="gr_ins" name="gr_ins" value="{{ (isset($empData['gr_ins']))?$empData['gr_ins']:'' }}" />
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>GPF</label>
                    <input class="form-control" type="text" id="total_dedu" name="total_dedu" value="{{ (isset($empData['total_dedu']))?$empData['total_dedu']:'' }}" />
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>GPF LOAN</label>
                    <input class="form-control" type="text" id="gpf_loan" name="gpf_loan" value="{{ (isset($empData['gpf_loan']))?$empData['gpf_loan']:'' }}" />
                </div>
            </div>
        </div>
        <div class="row col-sm-12">
            <!-- <div class="col-sm-4">
                <div class="form-group">
                    <label>CO OPERATIVE LOAN</label>
                    <input class="form-control" type="text" id="co_operative_loan" name="co_operative_loan" value="{{ $empData['co_operative_loan'] }}" />
                </div>
            </div> -->
            <div class="col-sm-4">
                <div class="form-group">
                    <label>TOTAL PAYMENT</label>
                    <input class="form-control" type="text" id="total_payment" name="total_payment" value="{{ (isset($empData['total_payment']))?$empData['total_payment']:'' }}" />
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>N.P.S. GOVT. SHARE</label>
                    <input class="form-control" type="text" id="nps_govt_share" name="nps_govt_share" value="{{(isset($empData['nps_govt_share']))?$empData['nps_govt_share']:'' }}" />
                </div>
            </div>
        </div> 
        @endif
        <div class="modal-footer">
            <button type="submit" id="update" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
  
