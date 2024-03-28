@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Users</h2>

        <form action="{{ route('users.index') }}" method="GET">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="title" name="filter[name]" placeholder="Search by name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="text" class="form-control" id="email" name="filter[email]" placeholder="Search by email">
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        @if ($users->isEmpty())
            <p>No users found.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <a href="{{ route('users.create') }}" class="btn btn-success">Create New User</a>

        <a href="{{ route('users.export') }}" class="btn btn-secondary">Export to Excel</a>
    </div>
@endsection




