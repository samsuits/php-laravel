@extends('layouts.app')

@section('content')
<h1>Assignment Status Details</h1>

<ul class="list-group">
    <li class="list-group-item"><strong>ID:</strong> {{ $assignmentStatus->id }}</li>
    <li class="list-group-item"><strong>Student:</strong> {{ $assignmentStatus->student->name }}</li>
    <li class="list-group-item"><strong>Assignment:</strong> {{ $assignmentStatus->assignment->title }}</li>
    <li class="list-group-item"><strong>Status:</strong> {{ ucwords($assignmentStatus->status) }}</li>
    <li class="list-group-item"><strong>Description:</strong> {{ $assignmentStatus->description }}</li>
</ul>

<a href="{{ route('assignment-statuses.index') }}" class="btn btn-secondary mt-3">Back</a>
@endsection