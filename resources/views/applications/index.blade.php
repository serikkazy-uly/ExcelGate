
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Applications</h2>
        @if ($applications->isEmpty())
            <p>No applications found.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $application)
                        <tr>
                            <td>{{ $application->title }}</td>
                            <td>{{ $application->description }}</td>
                            <td>
                                <a href="{{ route('applications.edit', $application->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('applications.destroy', $application->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this application?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <a href="{{ route('applications.create') }}" class="btn btn-success">Create New Application</a>
    </div>
@endsection
