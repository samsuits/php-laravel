<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Models\AssignmentStatus;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
        ]);

        $student = Student::create($validated);

        // Retrieve all existing assignments
        $assignments = Assignment::all();

        // Assign all assignments to the new student with "pending" status
        foreach ($assignments as $assignment) {
            // Create the assignment status for the student
            AssignmentStatus::create([
                'student_id' => $student->id,
                'assignment_id' => $assignment->id,
                'status' => 'pending',
                'description' => null, // or any default description, if needed
            ]);
        }

        return redirect()->route('students.index')->with('success', 'Student added successfully');
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,'.$student->id,
        ]);

        $student->update($validated);
        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }

    public function showAssignments(Student $student)
    {
        // Load assignments with their statuses for the given student
        $assignments = $student->assignmentStatuses()->with('assignment')->get();

        // print_r($assignments[0]->status);
        // die();

        return view('students.assignments.show', compact('student', 'assignments'));
    }
}