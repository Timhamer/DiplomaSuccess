<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Task;
use App\Models\Courses;
use App\Models\CoreTask;
use App\Models\Examiner;
use App\Models\ExamTask;
use App\Models\Workproces;
use Illuminate\Http\Request;
use App\Models\ExamWorkprocess;
use App\Models\User;
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
            $examinersq = Examiner::where('exam_id', $exam->id)->get();
            $examiners = array();


            $i = 0;
            foreach ($examinersq as $examiner) {
                $ExaminerUserID = $examiner->user_id;
                $examiners[$i] = User::where('id', $ExaminerUserID)->first();
                $i++;
            }

            if (!$examiners) {
                session(['user' => null]);
                return redirect()->route('login');
            }
        }

        if (isset($examiners)) {
            return view('Exam', compact('user', 'exam', 'examiners'));
        } else {
            return view('Exam', compact('user', 'exam'));
        }
    }

    public function see_exam(Request $request)
    {
        $ExamId = $request->input('exam_id');
        $UserId = session('user')->id;

        $existingExam = Exam::where('id', $ExamId)->where('user_id', $UserId)->where('published', 1)->first();

        if ($existingExam) {
            $existingExam->viewed_at = now();
            $existingExam->save();
        } else {
            return response()->json([
                'message' => 'Exam ID and User ID mismatch',
                'success' => false
            ], 200);
        }

        return response()->json([
            'message' => 'Exam viewed successfully',
            'success' => true
        ], 200);
    }

    public function editExam()
    {
        $courses = Courses::with('coretasks.workprocesses.tasks')
            ->get();
        return view('editDocument', compact('courses'));
    }

    public function feedback(Request $request)
    {
        $feedback = $request->input('feedback');
        $workprocess_id = $request->input('workprocess_id');
        $exam_id = $request->input('exam_id');

        // Check if a row exists with the given exam_id and task_id
        $existingWorkprocessFeedback = ExamWorkprocess::where('workprocess_id', $workprocess_id)->where('exam_id', $exam_id)->first();

        if ($existingWorkprocessFeedback) {
            // If the row exists, update the answer column
            $existingWorkprocessFeedback->feedback = $feedback;
            $existingWorkprocessFeedback->save();

            return response()->json([
                'message' => 'Feedback replaced successfully',
                'success' => true
            ], 200);
        } else {
            // If the row does not exist, create a new one
            $examWorkprocess = new ExamWorkprocess;
            $examWorkprocess->exam_id = $exam_id;
            $examWorkprocess->workprocess_id = $workprocess_id;
            $examWorkprocess->feedback = $feedback;
            $examWorkprocess->definitive = 0;
            $examWorkprocess->save();

            return response()->json([
                'message' => 'Feedback saved successfully',
                'success' => true
            ], 200);
        }
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

    public function insertCoretask(Request $request)
    {
        $courseId = $request->input('course_id');
        $name = $request->input('name');
        $code = $request->input('code');

        // Check if a row exists with the given exam_id and task_id
        $existingCoretask = CoreTask::where('course_id', $courseId)->where('code', $code)->first();

        if ($existingCoretask) {
            // If the row exists, update the answer column
            $existingCoretask->name = $name;
            $existingCoretask->save();
        } else {
            // If the row does not exist, create a new one
            $coretask = new CoreTask();
            $coretask->course_id = $courseId;
            $coretask->name = $name;
            $coretask->code = $code;
            $coretask->save();

            $coretask->refresh();
        }
        return response()->json(['coretask' => $coretask]);
    }
    public function insertWorkproces(Request $request)
    {
        $coretaskId = $request->input('coretask_id');
        $name = $request->input('name');
        $code = $request->input('code');

        // Check if a row exists with the given exam_id and task_id
        $existingWorkProces = Workproces::where('coretask_id', $coretaskId)->where('code', $code)->first();

        if ($existingWorkProces) {
            // If the row exists, update the answer column
            $existingWorkProces->name = $name;
            $existingWorkProces->save();
        } else {
            // If the row does not exist, create a new one
            $workProces = new Workproces();
            $workProces->coretask_id = $coretaskId;
            $workProces->name = $name;
            $workProces->code = $code;
            $workProces->save();

            $workProces->refresh();
        }
        return response()->json(['workproces' => $workProces]);
    }

    public function insertTask(Request $request)
    {
        $workProcesId = $request->input('workproces_id');
        $name = $request->input('name');
        $crucial = $request->input('crucial');
        $type = $request->input('type');
        $description = $request->input('description');
        $zero = $request->input('zero');
        $one = $request->input('one');
        $two = $request->input('two');
        $three = $request->input('three');

        // Check if a row exists with the given exam_id and task_id
        $existingTask = Task::where('workprocess_id', $workProcesId)->where('name', $name)->first();

        if ($existingTask) {
        } else {
            $task = new Task();
            $task->workprocess_id = $workProcesId;
            $task->name = $name;
            $task->crucial = $crucial;
            $task->type =$type;
            $task->description = $description;
            $task->zero = $zero;
            $task->one = $one;
            $task->two = $two;
            $task->three = $three;
            $task->save();

            $task->refresh();
        }
        return response()->json(['task' => $task]);
        
    }

    public function updateCoretask(Request $request)
    {
        $coretaskId = $request->input('coretask_id');
        $name = $request->input('name');
        $code = $request->input('code');

        // Check if a row exists with the given exam_id and task_id
        $existingCoretask = CoreTask::where('id', $coretaskId)->first();

        if ($existingCoretask) {
            // If the row exists, update the answer column
            $existingCoretask->name = $name;
            $existingCoretask->code = $code;
            $existingCoretask->save();
        } else {

           
        }
    }

    public function updateWorkproces(Request $request)
    {
        $workprocesId = $request->input('workproces_id');
        $name = $request->input('name');
        $code = $request->input('code');

        // Check if a row exists with the given exam_id and task_id
        $existingWorkProces = Workproces::where('id', $workprocesId)->first();

        if ($existingWorkProces) {
            // If the row exists, update the answer column
            $existingWorkProces->name = $name;
            $existingWorkProces->code = $code;
            $existingWorkProces->save();
        } else {

           
        }
    }

    public function updateTask(Request $request)
    {
        $taakId = $request->input('task_id');
        $name = $request->input('name');

        // Check if a row exists with the given exam_id and task_id
        $existingTask = Task::where('id', $taakId)->first();

        if ($existingTask) {
            // If the row exists, update the answer column
            $existingTask->name = $name;
            $existingTask->save();
            return response()->json(['message' => 'Task updated successfully']);

        } else {
            return response()->json(['message' => 'Task updated failed']);

           
        }
    }

    public function deleteCoretask(Request $request)
    {
        $coretaskId = $request->input('coretask_id');
        try {
            // Find the CoreTask by ID
            $coreTask = CoreTask::findOrFail($coretaskId);
    
            // Delete the CoreTask
            $coreTask->delete();
    
            // You can return a response indicating success if needed
            return response()->json(['message' => 'Core task deleted successfully']);
        } catch (\Exception $e) {
            // Handle any exceptions, such as the task not being found
            return response()->json(['error' => 'Error deleting core task: ' . $e->getMessage()], 500);
        }
    }

    public function deleteWorkproces(Request $request)
    {
        $workprocesId = $request->input('workproces_id');

        try {
            // Find the CoreTask by ID
            $workproces = Workproces::findOrFail($workprocesId);
    
            // Delete the CoreTask
            $workproces->delete();
    
            // You can return a response indicating success if needed
            return response()->json(['message' => 'Workproces deleted successfully']);
        } catch (\Exception $e) {
            // Handle any exceptions, such as the task not being found
            return response()->json(['error' => 'Error deleting workproces: ' . $e->getMessage()], 500);
        }
    }

    public function deleteTask(Request $request)
    {
        $taskId = $request->input('task_id');

        try {
            // Find the CoreTask by ID
            $task = Task::findOrFail($taskId);
    
            // Delete the CoreTask
            $task->delete();
    
            // You can return a response indicating success if needed
            return response()->json(['message' => 'Task deleted successfully']);
        } catch (\Exception $e) {
            // Handle any exceptions, such as the task not being found
            return response()->json(['error' => 'Error deleting task: ' . $e->getMessage()], 500);
        }
    }

}
