<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        #userButton {
            background-color: #4B49AC;
            color: white;
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
        input[type="checkbox"]{
            border:1px solid grey;
        }
        .form-check {
            margin-right: 1rem;
        }

        .form-check-inline {
            display: inline-block;
        }

    </style>
</head>
<body>
    @extends('dashboard.admin_dashboard')

    @section('users')
        <div class="container py-3">
            @can('Create Roles')
            <button type="button" id="userButton" class="btn btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#createUserModal">
                Create New User
            </button>
            @endcan
            <div class="table-wrapper mt-3">
                <div class="table-responsive">
                    <table class="table table-striped " id="usersTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
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


        <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createUserModalLabel">Create User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="userForm">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" placeholder="Enter name" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" placeholder="Enter Email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" placeholder="Enter Password" name="password" id="password" class="form-control" required>
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


        <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editUserForm">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="editUserId">
                            <div class="mb-3">
                                <label for="editname" class="form-label">Name</label>
                                <input type="text" placeholder="Enter name" name="name" id="editname" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="editEmail" class="form-label">Email</label>
                                <input type="email" placeholder="Enter Email" name="email" id="editEmail" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="editRoles" class="form-label">Roles</label>
                                @foreach($roles as $role)
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input role-checkbox" name="roles[]" value="{{ $role->id }}" id="editRole_{{ $role->id }}">
                                        <label class="form-check-label" for="editRole_{{ $role->id }}">{{ $role->name }}</label>
                                    </div>
                                @endforeach
                            </div>

                             <div class="mb-3">
                                <label for="editPermissions" class="form-label">Permissions</label>
                                @foreach($permissions as $permission)
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input permission-checkbox" name="permissions[]" value="{{ $permission->id }}" id="editPermission_{{ $permission->id }}">
                                        <label class="form-check-label" for="editPermission_{{ $permission->id }}">{{ $permission->name }}</label>
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


        <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteUserModalLabel">Delete User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this user?</p>
                        <form id="deleteUserForm">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" id="deleteUserId">
                            <button type="submit" class="btn btn-danger">Delete</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </form>
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
        var table = $('#usersTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'roles', name: 'roles' },
                { data: 'permissions', name: 'permissions' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });


        $('#userForm').on('submit', function(e) {
            e.preventDefault();

            // var roles = [];
            // $('input[name="roles[]"]:checked').each(function() {
            //     roles.push($(this).val());
            // });

            // var permissions = [];
            // $('input[name="permissions[]"]:checked').each(function() {
            //     permissions.push($(this).val());
            // });

            $.ajax({
                url: "{{ route('users.store') }}",
                type: "POST",
                data: {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    password: $('#password').val(),
                    // roles: roles,
                    // permissions: permissions,
                    _token: $('input[name="_token"]').val()
                },
                success: function(response) {
                    $('#createUserModal').modal('hide');
                    table.ajax.reload();
                    $('#userForm')[0].reset();
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });


        $(document).on('click', '.editUserBtn', function () {
    var userId = $(this).data('id');
    $.get('/users/' + userId, function (data) {
        $('#editUserId').val(data.id);
        $('#editname').val(data.name);
        $('#editEmail').val(data.email);


        $('input[name="roles[]"]').prop('checked', false);
        $.each(data.roles, function (key, role) {
            $('#editRole_' + role.id).prop('checked', true);
        });

        $('input[name="permissions[]"]').prop('checked', false);
         $.each(data.permissions, function (key, permission) {
             $('#editPermission_' + permission.id).prop('checked', true);
         });

        $('#editUserModal').modal('show');
    });
});


$('#editUserForm').on('submit', function (e) {
    e.preventDefault();
    var userId = $('#editUserId').val();

    $.ajax({
        url: '/users/' + userId,
        type: 'PUT',
        data: $(this).serialize(),
        success: function (response) {
            if (response.success) {
                $('#editUserModal').modal('hide');
                $('#usersTable').DataTable().ajax.reload();
                alert('User updated successfully.');
            } else {
                alert('Error updating user.');
            }
        }
    });
});



        $(document).on('click', '.deleteUserBtn', function() {
            var userId = $(this).data('id');
            $('#deleteUserId').val(userId);
            $('#deleteUserModal').modal('show');
        });

        $('#deleteUserForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('users.destroy', '') }}/" + $('#deleteUserId').val(),
                type: "DELETE",
                data: {
                    _token: $('input[name="_token"]').val()
                },
                success: function(response) {
                    $('#deleteUserModal').modal('hide');
                    table.ajax.reload();
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
        $('#createUserModal').on('hidden.bs.modal', function () {
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
        });


    });

</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        var superAdminCheckbox = Array.from(document.querySelectorAll('.role-checkbox')).find(function(checkbox) {
            return checkbox.nextElementSibling.textContent.trim() === 'Super Admin';
        });

        if (superAdminCheckbox) {
            superAdminCheckbox.addEventListener('change', function() {
                var isChecked = this.checked;
                document.querySelectorAll('.permission-checkbox').forEach(function(checkbox) {
                    checkbox.checked = isChecked;
                });
            });


        }
    });
</script>

    </body>
</html>
