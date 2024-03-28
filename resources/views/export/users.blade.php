@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Users Data</h2>
        
        <p>Click the button below to export users data to Excel:</p>
        <form action="{{ route('export.users') }}" method="post" enctype="multipart/form-data">
            @csrf
            <button type="submit" class="btn btn-primary">Export to Excel</button>
        </form>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>

                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
