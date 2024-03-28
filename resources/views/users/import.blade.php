


@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Import Users to Excel</h2>
        
        <p>Click the button below to import users data to Excel:</p>
        <form action="{{ route('users.import') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file">
            <button type="submit">Import Users</button>
        </form>
    </div>
@endsection