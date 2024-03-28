@extends('layouts.app')

@section('content')
    <h1>Application Details</h1>
    <p><strong>Title:</strong> {{ $application->title }}</p>
    <p><strong>Description:</strong> {{ $application->description }}</p>
    <a href="{{ route('applications.index') }}" class="btn btn-primary">Back to List</a>
@endsection
