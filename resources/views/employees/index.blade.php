@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Employee Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <form method="post" id="import_xls" action="{{ route('emp.import') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="file" name="xl_file" class="form-control"/>
                                </div>
                                <button type="button" id="import" class="btn btn-primary btn-sm">Import</button>
                            </form>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>S. No.</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '#import', function () {
            if ($('[name="xl_file"]').val()) {
                $('#import_xls').submit();
            } else {
                alert('Please select the excel to import.');
            }
        });
    });
</script>
@endpush
