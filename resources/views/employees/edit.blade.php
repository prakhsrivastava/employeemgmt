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
                                    <input type="radio" id="working" name="emp_status" @if($empData['emp_status'] == 'working') checked @endif value="working"/>
                                    <label for="working">Working</label>
                                    <input type="radio" id="retired" name="emp_status" @if($empData['emp_status'] == 'retired') checked @endif value="retired"/>
                                    <label for="retired">Retired</label>
                                    <input type="radio" id="ret_working" name="emp_status" @if($empData['emp_status'] == 'retired_working') checked @endif value="retired_working"/>
                                    <label for="ret_working">Retired Working</label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label>STATUS</label>
                                <div class="form-group">
                                    <input type="radio" id="active" name="status" @if($empData['status']) checked @endif value="1"/>
                                    <label for="active">Active</label>
                                    <input type="radio" id="inactive" name="status" @if(!$empData['status']) checked @endif value="0"/>
                                    <label for="inactive">Inactive</label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                <button type="submit" id="update" class="btn btn-primary form-control">Update</button>
                                </div>
                            </div>
                        </div>
                        @endif
                    </form>
                    <div id="table_data" class="row table-responsive">
                        <div class="row text-center"> 
                            <div class="col-sm-12 btn-group">
                                <button type="button" id="add" class="btn btn-success btn-sm">Add Arriears</button>
                                <button type="button" id="tax" class="btn btn-primary btn-sm">Tax Report</button>
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
<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Arriears</h4>
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