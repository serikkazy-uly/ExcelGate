@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Export Users to Excel</h2>
        
        <p>Click the button below to export users data to Excel:</p>
        <form action="{{ route('users.export') }}" method="post" enctype="multipart/form-data">
            @csrf
            <button type="submit" class="btn btn-primary">Export to Excel</button>
        </form>
    </div>
@endsection
