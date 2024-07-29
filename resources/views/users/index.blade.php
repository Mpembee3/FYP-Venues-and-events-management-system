@extends('layouts.sidebar')
@section('title', 'Manage Users')
@section('content2')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Registered Users</h4>        
        @if (session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="card">            
            <div class="card-body">
                <button class="btn rounded-pill btn-info mb-4" data-bs-toggle="modal" data-bs-target="#addUserModal">Add new</button>
                
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped table-hover datatable" id="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->firstname }} {{ $user->surname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                    <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST" id="roleForm-{{ $user->id }}">
                                            @csrf
                                            @method('PATCH')
                                            <select name="role" class="form-select" onchange="showRoleChangeModal({{ $user->id }}, this.value)">
                                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="PRO" {{ $user->role == 'PRO' ? 'selected' : '' }}>PRO</option>
                                                <option value="DVC" {{ $user->role == 'DVC' ? 'selected' : '' }}>DVC</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal-{{ $user->id }}">Delete</button>
                                    </td>
                                </tr>

                                <!-- Change Role Modal -->
                                <div class="modal fade" id="confirmRoleChangeModal-{{ $user->id }}" tabindex="-1" aria-labelledby="confirmRoleChangeModalLabel-{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmRoleChangeModalLabel-{{ $user->id }}">Change User Role</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to change the role of this user to <span id="newRole-{{ $user->id }}"></span>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary" onclick="submitRoleChangeForm({{ $user->id }})">Confirm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete User Modal -->
                                <div class="modal fade" id="confirmDeleteModal-{{ $user->id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel-{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmDeleteModalLabel-{{ $user->id }}">Delete User</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete this user?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Surname</label>
                        <input type="text" class="form-control" id="surname" name="surname" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="phone" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                            <option value="PRO">PRO</option>
                            <option value="DVC">DVC</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function showRoleChangeModal(userId, newRole) {
    document.getElementById('newRole-' + userId).innerText = newRole;
    var modal = new bootstrap.Modal(document.getElementById('confirmRoleChangeModal-' + userId));
    modal.show();
}

function submitRoleChangeForm(userId) {
    document.getElementById('roleForm-' + userId).submit();
}


</script>

@endsection
