<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $user = session('user');
        $course = Courses::where('id', $id)
            ->with('coreTasks.workProcesses.tasks')
            ->first();
    
        if ($course) {
            $exam = Exam::where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->first();
    
            if ($exam) {
                return view('Exam', compact('user', 'course'));
            } else {
                session(['user' => null]);
                return redirect()->route('login');
            }
        } else {
            session(['user' => null]);
            return redirect()->route('login');
        }
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
    public function show(Exam $exam)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        //
    }
}
