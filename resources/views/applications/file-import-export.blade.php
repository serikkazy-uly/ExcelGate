@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Import and Export Applications</h2>
        
        <h3>Import Applications</h3>
        <form action="{{ route('applications.file-import-export') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">Select file to import:</label>
                <input type="file" name="file" id="file" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Import</button>
        </form>

        <hr>

        <h3>Export Applications</h3>
        <p>Click the button below to export applications data to Excel:</p>
        <form action="{{ route('applications.export') }}" method="get">
            <button type="submit" class="btn btn-primary">Export to Excel</button>
        </form>
    </div>
@endsection
