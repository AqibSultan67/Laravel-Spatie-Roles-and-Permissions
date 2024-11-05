<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permissions</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        #permButton {
            background-color: #4B49AC;
            color: white;
        }
    </style>
</head>

<body>
    @extends('dashboard.admin_dashboard')
    @section('permissions')
        <div class="container py-3">
            <button type="button" id="permButton" class="btn btn-sm mt-3" data-bs-toggle="modal"
                data-bs-target="#defaultModal">
                Create Permissions
            </button>
            <div class="mt-3">
                <table class="table table-striped w-100" id="permissionsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>


        <div class="modal fade" id="defaultModal" tabindex="-1" aria-labelledby="defaultModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="defaultModalLabel">Create Permissions</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form id="permissionForm">
                            @csrf
                            <div class="mb-3">
                                <label for="permissionName" class="form-label">Permission Name</label>
                                <input type="text" placeholder="Enter Permission" name="name" id="permissionName" class="form-control" required>
                            </div>


                            <div class="mb-3">

                                <ul>

                                    <li>
                                        <strong>Articles Page:</strong>
                                        <ul>
                                            <li>Create Article</li>
                                            <li>Edit Article</li>
                                            <li>Delete Article</li>
                                        </ul>
                                    </li>


                                    <li>
                                        <strong>User Page:</strong>
                                        <ul>
                                            <li>Create New User</li>
                                            <li>Edit User</li>
                                            <li>Delete User</li>
                                        </ul>
                                    </li>

                                    <li>
                                        <strong>Roles:</strong>
                                        <ul>
                                            <li>Create Role</li>
                                            <li>Edit Role</li>
                                            <li>Delete Role</li>
                                        </ul>
                                    </li>


                                    <li>
                                        <strong>Permissions:</strong>
                                        <ul>
                                            <li>Create Permission</li>
                                            <li>Edit Permission</li>
                                            <li>Delete Permission</li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Permission</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editPermissionForm">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="editPermissionId">
                            <div class="mb-3">
                                <label for="editPermissionName" class="form-label">Permission Name</label>
                                <input type="text" placeholder="Enter Permission" name="name" id="editPermissionName"
                                    class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <script>
        $(document).ready(function() {
            var table = $('#permissionsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('permissions.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data) {
                            var date = new Date(data);
                            return date.toLocaleDateString('en-GB');
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });


            $('#permissionForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('permissions.store') }}",
                    method: 'POST',
                    data: {
                        name: $('#permissionName').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#defaultModal').modal('hide');
                        table.ajax.reload();
                        alert(response.success);
                        $('#permissionForm')[0].reset();
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        if (errors && errors.name) {
                            alert(errors.name[0]);
                        } else {
                            alert('Something went wrong. Please try again.');
                        }
                    }
                });
            });


            $('#permissionsTable').on('click', '.edit', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ url('permissions') }}/" + id + "/edit",
                    method: 'GET',
                    success: function(response) {
                        $('#editPermissionId').val(response.id);
                        $('#editPermissionName').val(response.name);
                        $('#editModal').modal('show');
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        alert('Failed to fetch data User does not have the right permissions.');
                    }
                });
            });

            $('#editPermissionForm').on('submit', function(e) {
                e.preventDefault();
                var id = $('#editPermissionId').val();
                $.ajax({
                    url: "{{ url('permissions') }}/" + id,
                    method: 'PUT',
                    data: {
                        name: $('#editPermissionName').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#editModal').modal('hide');
                        table.ajax.reload();
                        alert(response.success);
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        if (errors && errors.name) {
                            alert(errors.name[0]);
                        } else {
                            alert('Something went wrong. Please try again.');
                        }
                    }
                });
            });
            $('#defaultModal').on('hidden.bs.modal', function() {
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
            });
            $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var url = '{{ route('permissions.destroy', ':id') }}';
                url = url.replace(':id', id);

                if (confirm('Are you sure you want to delete this permission?')) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(result) {
                            alert(result.success);
                            table.ajax.reload();
                        },
                        error: function(xhr) {
                            alert('An error occurred while deleting the permission.');
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
