@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <h2>Export Applications to Excel</h2>
                
                <form action="{{ route('export.applications') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <button type="submit" class="btn btn-primary">Export to Excel</button>
                </form>
            </div>
        </div>
        
        <div class="row">
            <div class="col">
                <h2>Applications Data</h2>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applications as $application)
                            <tr>
                                <td>{{ $application->title }}</td>
                                <td>{{ $application->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
