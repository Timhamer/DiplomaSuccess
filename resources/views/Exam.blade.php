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
                                <div class="row">
                                    <div class="col-sm-9">
                                        <!-- Place your label on the left -->
                                        <label for="task">{{$task->name}}</label>
                                    </div>
                                    <div class="col-sm-3">
                                        @if ($task->type == 1)
                                            <div class="btn-group threeopt-radio" data-toggle="buttons">
                                                <label class="btn">
                                                    <input type="radio" name="{{$task->id}}_0" id="option1">0
                                                </label>
                                                <label class="btn">
                                                    <input type="radio" name="{{$task->id}}_1" id="option2">1
                                                </label>
                                                <label class="btn">
                                                    <input type="radio" name="{{$task->id}}_2" id="option2">2
                                                </label>
                                                <label class="btn">
                                                    <input type="radio" name="{{$task->id}}_3" id="option2">3
                                                </label>
                                            </div>
                                        @elseif ($task->type == 0)
                                            <div class="btn-group threeopt-radio" data-toggle="buttons">
                                                <label class="btn">
                                                    <input type="radio" name="{{$task->id}}_1" id="option1">Ja
                                                </label>
                                                <label class="btn">
                                                    <input type="radio" name="{{$task->id}}_0" id="option2">Nee
                                                </label>
                                            </div>
                                        @endif
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
</body>
</html>
@endsection
