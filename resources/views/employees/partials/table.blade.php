<div class="box-body no-padding border dataTable">
    <div class="col-sm-12 table-responsive">
        <table class="table table-bordered table-hover data-tables">
            <thead>
                <tr>
                    <th class="text-center">Actions</th>
                    <th>S. No.</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Pay Band / Level</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach (array_values($employees) as $key => $employee)   
                <tr>
                    <td class="text-center">
                        <div class="btn-group">
                            <form method="POST" action="{{ route('emp.delete', [$employee['id']]) }}">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-sm btn-danger" onclick="confirmDialog('Are you sure ?', function (e) {
                                    e.preventDefault();
                                    $(this).closest('form').submit();
                                })">Delete</button>
                            </form>
                            <button type="button" class="btn btn-sm btn-warning" onclick="window.location.href='{{ route('emp.edit', [$employee['id']]) }}'">Edit</button>
                        </div>
                    </td>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $employee['employee_name'] }}</td>
                    <td>{{ $employee['designation'] }}</td>
                    <td>{{ $employee['pay_band_level'] }}</td>
                    <td>{{ ($employee['status']) ? 'Active' : 'Inactive' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>