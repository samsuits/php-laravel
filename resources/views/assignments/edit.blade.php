@extends('layouts.app')

@section('content')
<h1>Edit Assignment</h1>
<form action="{{ route('assignments.update', $assignment->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" id="title" value="{{ $assignment->title }}" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" id="description" required>{{ $assignment->description }}</textarea>
    </div>
    <div class="form-group">
        <label for="due_date">Due Date</label>
        <input type="date" name="due_date" class="form-control" id="due_date" value="{{ $assignment->due_date->format('Y-m-d') }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Assignment</button>
    <a href="{{ route('assignments.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection