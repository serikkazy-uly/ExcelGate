@extends('layouts.app')

@section('content')
    <h1>Edit Application</h1>
    <!-- Форма для редактирования заявки -->
    <form action="{{ route('applications.update', $application->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ $application->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description" required>{{ $application->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
