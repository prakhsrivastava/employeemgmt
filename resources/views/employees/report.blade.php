@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Tax Report
                    <div class="text-right">
                        <a href="{{ route('emp.index') }}" class="link-text">Back to Dashboard</a>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="GET" class="form-horizontal">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label">Session Start</label>
                                    <select name="session_start" class="form-control">
                                        <option value="">Select</option>
                                        @for ($i = 2000; $i < date("Y") + 1; $i++)
                                        <option value="{{ $i }}" @if($session_start == $i) selected @endif>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label">Session End</label>
                                    <select name="session_end" class="form-control">
                                        <option value="">Select</option>
                                        @for ($i = 2000; $i <= date("Y") + 1; $i++)
                                        <option value="{{ $i }}" @if($session_end == $i) selected @endif>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-sm form-control">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="list-tab-outer d-flex justify-content-between">
                        <ul id="myTab4" role="tablist" class="nav nav-tabs card-tabs no-b r-0 align-self-end">
                            <li class="nav-item">
                                <a class="nav-link active show" id="tab1" data-toggle="tab" href="#gpf" role="tab"
                                    aria-controls="tab1" aria-expanded="true" aria-selected="true" title="G.P.F">G.P.F Report</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab2" data-toggle="tab" href="#nps" role="tab" aria-controls="tab2"
                                    aria-selected="false" title="N.P.S">N.P.S Report</a>
                            </li>
                        </ul>
                        <div class="text-right">
                            <button type="button" id="print" class="form-btn btn small-btn mb-2" title="Print" onclick="print_report()">Print</button>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="gpf" role="tabpanel" aria-labelledby="gpf">
                            @include('employees.partials.type_table', [
                                'type' => 'gpf',
                                'reports' => $tax_report
                            ])
                        </div>
                        <div class="tab-pane fade" id="nps" role="tabpanel" aria-labelledby="nps">
                            @include('employees.partials.type_table', [
                                'type' => 'nps',
                                'reports' => $tax_report
                            ])
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
    function print_report() {
        var session_start = $('[name="session_start"]').val();
        var session_end = $('[name="session_end"]').val();
        var type = $('.tab-pane.active', '.tab-content').attr('id');

        window.open('{{ route('emp.print_report', ['all']) }}?session_start='+session_start+'&session_end='+session_end+'&type='+type, '_tab');
    }
</script>
@endpush