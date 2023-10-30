<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Course;

class TeacherController extends Controller
{

    public function examenToevoegen(Request $request)
    {
        // Create a new Exam model instance
        $exam = new Exam;
        $exam->user_id = 1;
        $exam->course_id = $request->selected_course;
        $exam->published = 0;
        $exam->passed = 0;
        $exam->created_at = now();
        $exam->updated_at = now();

        $exam->save();

        if (isset($request->selected_teachers)) {
            $exam->examiners()->attach($request->selected_teachers);
        }

        return response()->json(['message' => 'Data saved successfully']);


    }

    public function opleidingToevoegen(Request $request)
    {
        // Create a new Exam model instance
        $course = new Courses;
        $course->name = $request->courseName;
        $course->crebo = $request->crebo;
        $course->created_at = now();
        $course->updated_at = now();

        $course->save();

//        if (isset($request->selected_teachers)) {
//            $exam->examiners()->attach($request->selected_teachers);
//        }

        return response()->json(['message' => 'Data saved successfully']);


    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
