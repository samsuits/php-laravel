@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $student->name }}'s Assignment Statuses</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Assignment Title</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($assignments as $status)
                <tr>
                    <td>{{ $status->assignment->title ?? 'N/A' }}</td>
                    <td>{{ optional($status->assignment)->due_date ? \Carbon\Carbon::parse($status->assignment->due_date)->format('M d, Y') : 'N/A' }}</td>
                    <td>{{ ucfirst($status->status) }}</td>
                    <td>{{ $status->description ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No assignments found for this student.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('students.statuses') }}" class="btn btn-secondary">Back to Student List</a>
</div>
@endsection