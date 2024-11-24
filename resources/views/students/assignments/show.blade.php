@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Assignments Status of {{ $student->name }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Assignment</th>
                <th>Status</th>
                <th>Description</th>  <!-- Optional, based on your description field -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assignments as $assignment)
                <tr>

                    <td>{{ $assignment->assignment->title }}</td>
                    <td class="{{ $assignment->status === 'completed' ? 'bg-complete' : ($assignment->status === 'partial' ? 'bg-partial-complete' : 'bg-pending') }}">{{ $assignment->status }}</td>
                    <td>{{ $assignment->description }}</td>
                    <td>
                    <a href="{{ route('assignment-statuses.edit', $assignment->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('students.index') }}" class="btn btn-primary">Back to Students</a>
</div>
@endsection