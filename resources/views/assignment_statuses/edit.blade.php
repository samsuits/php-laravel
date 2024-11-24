@extends('layouts.app')

@section('content')
<h1>Edit Assignment Status</h1>

<form action="{{ route('assignment-statuses.update', $assignmentStatus->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="student_id">Student</label>
        <select name="student_id" class="form-control" id="student_id" required>
            @foreach ($students as $student)
                <option value="{{ $student->id }}" {{ $student->id === $assignmentStatus->student_id ? 'selected' : '' }}>
                    {{ $student->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="assignment_id">Assignment</label>
        <select name="assignment_id" class="form-control" id="assignment_id" required>
            @foreach ($assignments as $assignment)
                <option value="{{ $assignment->id }}" {{ $assignment->id === $assignmentStatus->assignment_id ? 'selected' : '' }}>
                    {{ $assignment->title }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" class="form-control" id="status" required>
            <option value="pending" {{ $assignmentStatus->status === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="completed" {{ $assignmentStatus->status === 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="partial" {{ $assignmentStatus->status === 'partial' ? 'selected' : '' }}>Partially Completed</option>
            <option value="overdue" {{ $assignmentStatus->status === 'overdue' ? 'selected' : '' }}>Overdue</option>
        </select>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" id="description" rows="3">{{ $assignmentStatus->description }}</textarea>
    </div>
    <button type="submit" class="btn btn-warning">Update Status</button>
    <a href="{{ route('assignment-statuses.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection