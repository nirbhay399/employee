@extends('layouts.app')
@section('main')
    <div class="container">
        <div class="text-right">
            <a href="employees/create" class="btn btn-dark mt-2">Add Employee</a>
        </div>
        <table class="table table-hover mt-2">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>DOB</th>
                    <th>Joining Date</th>
                    <th>Contact No</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                <tr data-employee-id="{{$employee->id}}">
                    <td>{{ $loop->index+1 }}</td>
                    <td>
                        <a href="employees/{{ $employee->id }}/show" class="text-dark"> {{ $employee->name }}</a>
                    </td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->gender }}</td>
                    <td>{{ $employee->dob }}</td>
                    <td>{{ $employee->joining_date }}</td>
                    <td>{{ $employee->contact_number }}</td>
                    <td>
                        <a href="employees/{{$employee->id}}/show" class="btn btn-success btn-sm">Show</a>
                        <a href="employees/{{$employee->id}}/edit" class="btn btn-dark btn-sm">Edit</a>

                        <button type="button" class="btn btn-danger btn-sm" id="deleteButton" onclick="confirmDelete({{$employee->id}})">Delete</button>
                        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmDeleteModalLabel"><b>Confirm Delete</b></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this Employee?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                        <button id="deleteButton" class="btn btn-danger" onclick="deleteEmployee()">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $employees->links() }}
    </div>
@endsection
<script>
    function confirmDelete(id) {
        $('#confirmDeleteModal').modal('show');

        // Store the ID in a data attribute of the delete button
        $('#deleteButton').data('item-id', id);
    }

    function deleteEmployee() {

        // Delete logic goes here
        var id = $('#deleteButton').data('item-id');

        // Send an AJAX request to delete the Employee
        $.ajax({
            url: '/employees/' + id + '/delete',
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert(response.message);
                $('#confirmDeleteModal').modal('hide');
                $('.modal-backdrop').remove();
                $('tbody').find("[data-employee-id='" + id + "']").remove();
            },
            error: function(error) {
                alert('Error deleting item: ' + error.responseJSON.message);
            }
        });
    }
</script>
