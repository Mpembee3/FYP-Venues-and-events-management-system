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
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
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
                                        <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <select name="role" class="form-select" onchange="this.form.submit()">
                                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="PRO" {{ $user->role == 'PRO' ? 'selected' : '' }}>PRO</option>
                                                <option value="DVC" {{ $user->role == 'DVC' ? 'selected' : '' }}>DVC</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection