@extends('layouts.app')

@section('content')
<h1>Assignment Statuses</h1>
<a href="{{ route('assignment-statuses.create') }}" class="btn btn-primary">Add Assignment Status</a>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Student</th>
            <th>Assignment</th>
            <th>Status</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($statuses as $status)
            <tr>
                <td>{{ $status->id }}</td>
                <td>{{ $status->student->name }}</td>
                <td>{{ $status->assignment->title }}</td>
                <td class="{{ $status->status === 'completed' ? 'bg-complete' : 'bg-pending' }}">{{ $status->status }}</td>
                <td title="{{ $status->description }}">

                    {{-- {{ $status->description }} --}}
                    {{ strlen($status->description) > 50 ? substr($status->description, 0, 50) . '...' : $status->description }}

                </td>
                <td>
                    <a href="{{ route('assignment-statuses.edit', $status->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('assignment-statuses.destroy', $status->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this status?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection