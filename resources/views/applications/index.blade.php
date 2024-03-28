@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Applications</h2>

        <!-- Форма для фильтрации -->
        <form action="{{ route('applications.index') }}" method="GET">
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control" id="title" name="filter[title]" placeholder="Search by title">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <input type="text" class="form-control" id="description" name="filter[description]" placeholder="Search by description">
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

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

        <!-- Кнопка для экспорта в Excel -->
        <a href="{{ route('applications.export') }}" class="btn btn-secondary">Export to Excel</a>
    </div>
@endsection




