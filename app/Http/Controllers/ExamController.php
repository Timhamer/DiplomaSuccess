<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Courses;
use App\Models\Examiner;
use App\Models\ExamTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id, Request $request)
{
    $user = session('user');
    

        // if ($user->role == 1) {
        //     $exam = Exam::where('id', $id)
        //     ->where('user_id', $user->id)
        //     ->with('course.coreTasks.workProcesses.tasks.taskValues')
        //     ->first();

        if ($user->role == 1) {
            $exam = Exam::where('id', $id)
            ->where('user_id', $user->id)
            ->with('course.coreTasks.workProcesses.tasks.taskValues')
            ->first();
        
        // if ($exam) {
        //     // You should check if the exam was found before using it
        //     $taskValues = ExamTask::where('exam_id', $exam->id)->get();
        
        //     foreach ($taskValues as $taskValue) {
        //         // Find the corresponding task in the exam's course, coreTasks, and workProcesses
        //         $matchingTask = $exam->course->coreTasks
        //             ->pluck('workProcesses')
        //             ->flatten()
        //             ->pluck('tasks')
        //             ->flatten()
        //             ->where('id', $taskValue->task_id)
        //             ->first();
        //             $matchingTask->answer = 6;
        //             // dump($matchingTask);
        //         // if ($matchingTask) {
        //         //     // Bind the answer
        //         // }
        //     }
        //     // dd($exam);
        //     // $tasks = $exam->course->coreTasks->workProcesses->task;
        // }
        
        

    
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
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $examId = $request->input('exam_id');
    $taskId = $request->input('task_id');
    $selectedValue = $request->input('selected_value');

    // Check if a row exists with the given exam_id and task_id
    $existingExamTask = ExamTask::where('exam_id', $examId)->where('task_id', $taskId)->first();

    if ($existingExamTask) {
        // If the row exists, update the answer column
        $existingExamTask->answer = $selectedValue;
        $existingExamTask->save();
    } else {
        // If the row does not exist, create a new one
        $examTask = new ExamTask;
        $examTask->exam_id = $examId;
        $examTask->task_id = $taskId;
        $examTask->answer = $selectedValue;
        $examTask->save();
    }

    return redirect()->back();
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
