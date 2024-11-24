@extends('layouts.app')

@section('content')
<h1>Assignments</h1>
<a href="{{ route('assignments.create') }}" class="btn btn-primary">Add Assignment</a>

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($assignments as $assignment)
        <tr>
            <td>{{ $assignment->id }}</td>
            <td>{{ $assignment->title }}</td>
            <td>{{ $assignment->description }}</td>
            <td>{{ $assignment->due_date }}</td>
            <td><a href="{{ route('assignments.student-statuses', $assignment->id) }}" class="btn btn-info">Student Statuses</a></td>
            <td>
                <a href="{{ route('assignments.edit', $assignment->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('assignments.destroy', $assignment->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection