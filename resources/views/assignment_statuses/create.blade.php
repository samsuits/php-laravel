@extends('layouts.app')

@section('content')
<h1>Add Assignment Status</h1>

<form action="{{ route('assignment-statuses.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="student_id">Student</label>
        <select name="student_id" class="form-control" id="student_id" required>
            <option value="">Select a Student</option>
            @foreach ($students as $student)
                <option value="{{ $student->id }}">{{ $student->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="assignment_id">Assignment</label>
        <select name="assignment_id" class="form-control" id="assignment_id" required>
            <option value="">Select an Assignment</option>
            @foreach ($assignments as $assignment)
                <option value="{{ $assignment->id }}">{{ $assignment->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" class="form-control" id="status" required>
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>
            <option value="partial">Partially Completed</option>
            <option value="overdue">Overdue</option>
        </select>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" id="description" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Add Status</button>
    <a href="{{ route('assignment-statuses.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection