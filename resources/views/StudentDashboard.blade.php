@extends('layouts.popup')
@extends('layouts.app')

<!DOCTYPE html>
<html>
<head>
    <title>Popup Example</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<button class="btn btn-primary" id="showPopup">+</button>

<<<<<<< Updated upstream
=======
<div class="container">
    @foreach ($users as $user)
        <div class="card mb-3">
            <div class="card-header" data-toggle="collapse" data-target="#user-{{$user->id}}">
                <!--<label>{{ $user->first_name }} {{ $user->last_name  }}</label>-->

                <div class="row">
                    <div class="col-sm-11">
                        <label>{{ $user->first_name }} {{ $user->last_name  }}</label>
                    </div>

                    <div class="col-sm-1">
                        <label>v</label>
                    </div>
                </div>
            </div>
            <div class="collapse" id="user-{{$user->id}}">
                <div class="card-body">
                    @foreach ($user->exams as $exam)
                        <div class="row">
                            <div class="col-sm-8">
                                <label>Opleiding {{ $exam->course->name }}</label>
                            </div>

                            <div class="col-sm-4">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exam-{{$exam->id}}">Bekijk examen</button>
                            </div>
                        </div>
                    @endforeach

                    <div class="row">
                        <div class="col-sm-5">
                            <hr>
                        </div>

                        <div class="col-sm-2">
                            <button type="button" class="btn btn-primary">+</button>
                        </div>

                        <div class="col-sm-5">
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
>>>>>>> Stashed changes

<!-- Include Bootstrap JS (jQuery and Popper.js are required for Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
</html>
