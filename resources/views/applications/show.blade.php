@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Application Details</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $application->title }}</h5>
                <p class="card-text">{{ $application->description }}</p>
                <a href="{{ route('applications.edit', $application->id) }}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
@endsection
