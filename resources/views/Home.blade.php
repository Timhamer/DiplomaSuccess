@extends('layouts.app')

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Rows of Divs</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/feedback-box.js"></script>
</head>
@section('content')

    <body>

    @foreach ($exams as $exam)
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="my-3 p-3 bg-light">
                        <div class="row">
                            <div class="col-9">
                                <h4>{{ $exam->course->name }}</h4>
                            </div>
                            <div class="col-3">
                                <a href="{{ route('Examine', ['id' => $exam->course->id]) }}">

                                    <button class="btn btn-primary">Bekijk</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <button class="btn btn-primary" onclick="FeedbackBox()">Feedback geven</button>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
@endsection
