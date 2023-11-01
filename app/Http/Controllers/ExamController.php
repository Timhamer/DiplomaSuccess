<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Courses;
use App\Models\Examiner;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $user = session('user');

        if ($user->role == 1) {
            $exam = Exam::where('id', $id)
                ->where('user_id', $user->id)
                ->with('course.coreTasks.workProcesses.tasks')
                ->first();
        } elseif ($user->role == 2) {
            $exam = Exam::where('id', $id)
                ->first();
        } else {
            // Handle other roles or invalid roles here
            session(['user' => null]);
            return redirect()->route('login');
        }

        if (!$exam) {
            session(['user' => null]);
            return redirect()->route('login');
        }

        if ($user->role == 2) {
            $examiner = Examiner::where('user_id', $user->id)
                ->where('exam_id', $exam->id)
                ->first();

            if (!$examiner) {
                session(['user' => null]);
                return redirect()->route('login');
            }
        }

        return view('Exam', compact('user', 'exam'));
    }

    public function feedback(Request $request)
    {
        echo "<script>console.log('a')</script>";
        echo "<script>console.log('Debug Objects: " . $request->feedback . "' );</script>";

        $user = session('user');

        if ($user->role != 2) {
            session(['user' => null]);
            return redirect()->route('login');
        } else {
            $examiner = Examiner::where('user_id', $user->id)
                ->where('exam_id', $request->exam_id)
                ->first();

            if (!$examiner) {
                session(['user' => null]);
                return redirect()->route('login');
            } else {
                // Update the feedback row in the exam_work_process table
                $examiner->feedback = $request->feedback;
                $examiner->save();
            }
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
