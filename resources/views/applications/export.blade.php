@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Export Applications to Excel</h2>
        
        <p>Click the button below to export applications data to Excel:</p>
        <form action="{{ route('applications.export') }}" method="get" enctype="multipart/form-data">
            {{-- @csrf --}}
            <button type="submit" class="btn btn-primary">Export to Excel</button>
        </form>
    </div>
@endsection
