<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;


class CoursController extends Controller
{
     public function index()
    {
        $courses = Course::with('students')->get();
        return Inertia::render('Courses/Index', ['courses' => $courses]);
    }

    public function create()
    {
        $students = Student::all();
        return Inertia::render('Courses/Create', ['students' => $students]);
    }

    public function store(Request $request)
    {
        dd($request->all());
        $data = $request->validate([
            'titel' => 'required|string|max:255',
            'description' => 'nullable|string',
            'students' => 'array',
            'students.*' => 'exists:students,id',
        ]);

        $course = Course::create([
            'titel' => $data['titel'],
            'description' => $data['description'],
        ]);

        if (!empty($data['students'])) {
        $course->students()->attach($data['students']);
    }

        return redirect()->route('courses.index')->with('success', 'Course created.');
    }

    public function edit(Course $course)
    {
        $students = Student::all();
        $course->load('students');
        return Inertia::render('Courses/Edit', [
            'course' => $course,
            'students' => $students,
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'titel' => 'required|string|max:255',
            'description' => 'nullable|string',
            'students' => 'array',
            'students.*' => 'exists:students,id',
        ]);

        $course->update([
            'titel' => $data['titel'],
            'description' => $data['description'] ?? null,
        ]);

        if (isset($data['students'])) {
            $course->students()->sync($data['students']);
        } else {
            $course->students()->detach();
        }

        return redirect()->route('courses.index')->with('success', 'Course updated.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted.');
    }
}
