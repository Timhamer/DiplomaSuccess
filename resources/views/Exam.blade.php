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
    @foreach($course->coretasks as $coretask)
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
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- Place your label on the left -->
                                        <label for="task">{{$task->name}}</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- Place your choice buttons on the right -->
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn">
                                                <input type="radio" name="options" id="option1"> Button 1
                                            </label>
                                            <label class="btn">
                                                <input type="radio" name="options" id="option2"> Button 2
                                            </label>
                                            <label class="btn">
                                                <input type="radio" name="options" id="option2"> Button 3
                                            </label>
                                        </div>
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
</body>
</html>
@endsection