


@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Import Applications to Excel</h2>
        
        <p>Click the button below to import applications data to Excel:</p>
        <form action="{{ route('applications.import') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file">
            <button type="submit">Import Applications</button>
        </form>
    </div>
@endsection