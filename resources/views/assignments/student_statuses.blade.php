@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Status for Assignment: {{ $assignment->title }}</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Status</th>
                <th>Description</th>  <!-- Optional, based on your description field -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td class="{{  $student->assignmentStatuses->first()->status === 'completed' ? 'bg-complete' : ($student->assignmentStatuses->first()->status === 'partial' ? 'bg-partial-complete' : 'bg-pending') }}">
                        @if ($student->assignmentStatuses->isNotEmpty())
                            {{ $student->assignmentStatuses->first()->status }}
                        @else
                            Not Submitted
                        @endif
                    </td>
                    <td>
                        @if ($student->assignmentStatuses->isNotEmpty())
                            {{ $student->assignmentStatuses->first()->description ?? 'No description' }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('assignment-statuses.edit', $student->assignmentStatuses->first()->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('assignments.index') }}" class="btn btn-primary">Back to Assignments</a>
</div>
@endsection