<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Models\AssignmentStatus;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::all();
        return view('assignments.index', compact('assignments'));
    }

    public function create()
    {
        return view('assignments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
        ]);

        $assignment = Assignment::create($validated);

        // Get all students
        $students = Student::all();

        // Create an assignment status for each student with "pending" status
        foreach ($students as $student) {
            AssignmentStatus::create([
                'student_id' => $student->id,
                'assignment_id' => $assignment->id,
                'status' => 'pending',
                'description' => null // Optionally, set any default description
            ]);
        }

        return redirect()->route('assignments.index')->with('success', 'Assignment added successfully');
    }

    public function edit(Assignment $assignment)
    {
        return view('assignments.edit', compact('assignment'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
        ]);

        $assignment->update($validated);
        return redirect()->route('assignments.index')->with('success', 'Assignment updated successfully');
    }

    public function destroy(Assignment $assignment)
    {
        $assignment->delete();
        return redirect()->route('assignments.index')->with('success', 'Assignment deleted successfully');
    }

    public function studentStatuses(Assignment $assignment)
    {
        // Get all students and their corresponding status for the given assignment
        $students = Student::with(['assignmentStatuses' => function ($query) use ($assignment) {
            $query->where('assignment_id', $assignment->id);
        }])->get();

        return view('assignments.student_statuses', compact('assignment', 'students'));
    }
}
