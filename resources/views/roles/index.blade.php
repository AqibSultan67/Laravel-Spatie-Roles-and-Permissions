<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        #permButton {
            background-color: #4B49AC;
            color: white;
        }
        input[type="checkbox"]{
            border:1px solid grey;
        }
        .table-wrapper {
            display: flex;
            flex-direction: row;
            overflow: hidden;
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow: hidden;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
            white-space: nowrap;

        }

        .table th {
            background-color: #f8f9fa;
            color: #212529;
        }

        .table tbody tr {
            border-bottom: 1px solid #dee2e6;
        }


        .table td,
        .table th {
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px;

            word-wrap: break-word;

        }
    </style>
</head>

<body>
    @extends('dashboard.admin_dashboard')

    @section('roles')
        <div class="container py-3">
            <button type="button" id="permButton" class="btn btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#defaultModal">
                Create New Role
            </button>
            <div class="table-wrapper mt-3">
                <div class="table-responsive">
                <table class="table table-striped" id="rolesTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Permissions</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        </div>

        <!-- Create Role Modal -->
        <div class="modal fade" id="defaultModal" tabindex="-1" aria-labelledby="defaultModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="defaultModalLabel">Create Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="roleForm">
                            @csrf
                            <div class="mb-3">
                                <label for="roleName" class="form-label">Role Name</label>
                                <input type="text" placeholder="Enter Role" name="name" id="roleName" class="form-control" required>
                            </div>
                            <div class="row">
                                @foreach($permissions as $permission)
                                    <div class="col-md-4 d-flex align-items-center">
                                        <input type="checkbox" class="form-check-input me-1" name="permissions[]" value="{{ $permission->id }}" id="permission_{{ $permission->id }}">
                                        <label class="form-check-label" for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Save</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

       <!-- Edit Role Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editroleForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editroleId">
                    <div class="mb-3">
                        <label for="editroleName" class="form-label">Role Name</label>
                        <input type="text" placeholder="Enter Role" name="name" id="editroleName" class="form-control" required>
                    </div>
                    <div class="row">
                        @foreach($permissions as $permission)
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-1" name="editpermissions[]" value="{{ $permission->id }}" id="editpermission_{{ $permission->id }}">
                                <label class="form-check-label" for="editpermission_{{ $permission->id }}">{{ $permission->name }}</label>
                            </div>
                        @endforeach
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
            var table = $('#rolesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('roles.index') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'permissions', name: 'permissions' },
                    { data: 'created_at', name: 'created_at', render: function(data) {
                        var date = new Date(data);
                        return date.toLocaleDateString('en-GB');
                    }},
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });


            $('#roleForm').on('submit', function(e) {
                e.preventDefault();

                var permissions = [];
                $('input[name="permissions[]"]:checked').each(function() {
                    permissions.push($(this).val());
                });

                $.ajax({
                    url: "{{ route('roles.store') }}",
                    type: "POST",
                    data: {
                        name: $('#roleName').val(),
                        permissions: permissions,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#defaultModal').modal('hide');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });


    $(document).on('click', '.edit', function() {
        var roleId = $(this).data('id');

        $.ajax({
            url: "{{ url('roles') }}/" + roleId + "/edit",
            type: "GET",
            success: function(data) {
                $('#editroleId').val(data.id);
                $('#editroleName').val(data.name);


                $('input[name="editpermissions[]"]').prop('checked', false);


                data.permissions.forEach(function(permission) {
                    $('#editpermission_' + permission.id).prop('checked', true);
                });


                $('#editModal').modal('show');
            },
            error: function(response) {
                console.log('Failed to fetch role data.');
            }
        });
    });
            $('#editroleForm').on('submit', function(e) {
                e.preventDefault();

                var permissions = [];
                $('input[name="editpermissions[]"]:checked').each(function() {
                    permissions.push($(this).val());
                });

                $.ajax({
                    url: "{{ url('roles') }}/" + $('#editroleId').val(),
                    type: "PUT",
                    data: {
                        name: $('#editroleName').val(),
                        permissions: permissions,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#editModal').modal('hide');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });


            $(document).on('click', '.delete', function() {
                var roleId = $(this).data('id');

                if (confirm('Are you sure you want to delete this role?')) {
                    $.ajax({
                        url: "{{ url('roles') }}/" + roleId,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            table.ajax.reload();
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
            $('#defaultModal').on('hidden.bs.modal', function () {
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
        });
        });

    </script>
</body>
</html>
