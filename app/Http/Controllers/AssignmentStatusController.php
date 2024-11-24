<?php

namespace App\Http\Controllers;

use App\Models\AssignmentStatus;
use App\Models\Assignment;
use App\Models\Student;
use Illuminate\Http\Request;

class AssignmentStatusController extends Controller
{
    public function index()
    {
        $statuses = AssignmentStatus::with(['student', 'assignment'])->get();
        return view('assignment_statuses.index', compact('statuses'));
    }

    public function create()
    {
        $students = Student::all();
        $assignments = Assignment::all();
        return view('assignment_statuses.create', compact('students', 'assignments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'assignment_id' => 'required|exists:assignments,id',
            'status' => 'required|in:pending,completed,partial,overdue',
            'description' => 'nullable|string|max:255', // Validate the description
        ]);

        AssignmentStatus::create($request->all());

        return redirect()->route('assignment-statuses.index')->with('success', 'Assignment status added successfully.');
    }

    public function edit(AssignmentStatus $assignmentStatus)
    {
        $students = Student::all();
        $assignments = Assignment::all();
        return view('assignment_statuses.edit', compact('assignmentStatus', 'students', 'assignments'));
    }

    public function update(Request $request, AssignmentStatus $assignmentStatus)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'assignment_id' => 'required|exists:assignments,id',
            'status' => 'required|in:pending,completed,partial,overdue',
            'description' => 'nullable|string|max:255', // Validate the description
        ]);

        $assignmentStatus->update($request->all());

        return redirect()->route('assignment-statuses.index')->with('success', 'Assignment status updated successfully.');
    }

    public function destroy(AssignmentStatus $assignmentStatus)
    {
        $assignmentStatus->delete();
        return redirect()->route('assignment-statuses.index')->with('success', 'Assignment status deleted successfully');
    }
}
