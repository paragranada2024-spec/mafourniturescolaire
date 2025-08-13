<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;


class StudentController extends Controller
{
    public function index()
{
    $students = Student::with('courses')->get();  

    return Inertia::render('Students/Index', [
        'students' => $students,
    ]);
}
public function edit(Student $student)
{
    $courses = Course::all(['id', 'titel']);

    return Inertia::render('Students/Edit', [
        'student' => $student->load('courses'),
        'courses' => $courses,
    ]);
}


public function create()
{
    $courses = Course::all(['id', 'titel']); 

    return Inertia::render('Students/Create', [
        'courses' => $courses,
    ]);
}


public function store(Request $request)
{
    $validated = $request->validate([
        'name'      => ['required', 'string', 'max:255'],
        'email'     => ['required', 'email', 'max:255', 'unique:students,email'],
        'note'      => ['nullable', 'numeric', 'between:0,20'],
        'course_id' => ['required', 'exists:courses,id'],
    ]);

    $student = Student::create([
        'name'  => $validated['name'],
        'email' => $validated['email'],
        'note'  => $validated['note'],
    ]);

    $student->courses()->attach($validated['course_id']);

    return redirect()->route('students.index')->with('success', 'Student created successfully!');
}

public function update(Request $request, Student $student)
{
    $validated = $request->validate([
        'name'      => ['required', 'string', 'max:255'],
        'email'     => ['required', 'email', 'max:255', 'unique:students,email,' . $student->id],
        'note'      => ['nullable', 'numeric', 'between:0,20'],
        'course_id' => ['required', 'exists:courses,id'],
    ]);

    $student->update([
        'name'  => $validated['name'],
        'email' => $validated['email'],
        'note'  => $validated['note'],
    ]);

    $student->courses()->sync([$validated['course_id']]);

    return redirect()->route('students.index')->with('success', 'Student updated successfully!');
}


    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted.');
    }
}
