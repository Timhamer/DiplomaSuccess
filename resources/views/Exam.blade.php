@extends('layouts.app')

    <!DOCTYPE html>
<html>
<head>
    <title>Studenten dashboard</title>
    {{--    <pre>--}}
    {{--    </pre>--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
@section('content')

    <div class="container">
        @foreach($exam->course->coretasks as $coretask)
            <div class="card-header kerntaak-header" data-toggle="collapse" data-target="#kerntaak-{{$coretask->id}}">
                <div class="row">
                    <div class="col-sm-11">
                        <label>Kerntaak</label>
                    </div>
                    <div class="col-sm-1">
                        <label>v</label>
                    </div>
                </div>
            </div>

            <div class="collapse" id="kerntaak-{{$coretask->id}}">
                @foreach($coretask->workprocesses as $workprocess)
                    <div class="card-header werkproces-header" data-toggle="collapse"
                         data-target="#workprocess-{{$workprocess->id}}">
                        <div class="row">
                            <div class="col-sm-11">
                                <label>{{$workprocess->name}}</label>
                            </div>
                            <div class="col-sm-1">
                                <label>v</label>
                            </div>
                        </div>
                    </div>

                    <div class="collapse" id="workprocess-{{$workprocess->id}}">
                        @foreach($workprocess->tasks as $task)
                            <div class="row taak">
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- Place your label on the left -->
                                            <label for="task">{{$task->name}}</label>
                                        </div>
                                        <div class="col-sm-6">
                                            @if ($task->type == 1)
                                                <div class="btn-group threeopt-radio" data-toggle="buttons">
                                                    <label class="btn">
                                                        <input type="radio" name="options" class="task-option" value="0" data-exam-id="{{ $exam->id }}" data-task-id="{{ $task->id }}" data-route="{{ $exam->id }}">0
                                                    </label>
                                                    <label class="btn">
                                                        <input type="radio" name="options" class="task-option" value="1" data-exam-id="{{ $exam->id }}" data-task-id="{{ $task->id }}" data-route="{{ $exam->id }}">1
                                                    </label>
                                                    <label class="btn">
                                                        <input type="radio" name="options" class="task-option" value="2" data-exam-id="{{ $exam->id }}" data-task-id="{{ $task->id }}" data-route="{{ $exam->id }}">2
                                                    </label>
                                                    <label class="btn">
                                                        <input type="radio" name="options" class="task-option" value="3" data-exam-id="{{ $exam->id }}" data-task-id="{{ $task->id }}" data-route="{{ $exam->id }}">3
                                                    </label>
                                                </div>
                                            @elseif ($task->type == 0)
                                                <div class="btn-group threeopt-radio" data-toggle="buttons">
                                                    <label class="btn">
                                                        <input type="radio" name="options" class="task-option" value="0" data-exam-id="{{ $exam->id }}" data-task-id="{{ $task->id }}" data-route="{{ $exam->id }}">Nee
                                                    </label>
                                                    <label class="btn">
                                                        <input type="radio" name="options" class="task-option" value="1" data-exam-id="{{ $exam->id }}" data-task-id="{{ $task->id }}" data-route="{{ $exam->id }}">Ja
                                                    </label>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                @endforeach

            </div>
        @endforeach

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('.task-option').on('click', function() {
                var selectedValue = $(this).val();
                var examId = $(this).data('exam-id');
                var taskId = $(this).data('task-id');
                
                $.ajax({
                    type: 'POST',
                    url: this.getAttribute('data-route'), // Update the URL to the route that will handle the submission
                    data: {
                        _token: '{{ csrf_token() }}',
                        exam_id: examId,
                        task_id: taskId,
                        selected_value: selectedValue
                    },
                    success: function(response) {
                        // Handle success response if needed
                    },
                    error: function(xhr) {
                        // Handle error response if needed
                    }
                });
            });
        });
    </script>
    
</body>
</html>
@endsection
