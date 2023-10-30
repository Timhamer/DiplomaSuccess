@extends('layouts.app')

<!DOCTYPE html>
<html>
<head>
    <title>Studenten dashboard</title>
    {{ $courses }}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="card-header kerntaak-header" data-toggle="collapse" data-target="#user-1">
        <div class="row">
            <div class="col-sm-11">
                <label>Kerntaak</label>
            </div>
            <div class="col-sm-1">
                <label>v</label>
            </div>
        </div>
    </div>
    <div class="collapse" id="user-1">
        <!-- We need to add additional collapsable layers to show info. -->
        <div class="card-header werkproces-header" data-toggle="collapse" data-target="#user-1-1">
            <div class="row">
                <div class="col-sm-11">
                    <label>Werkproces</label>
                </div>
                <div class="col-sm-1">
                    <label>v</label>
                </div>
            </div>
        </div>

        <div class="collapse" id="user-1-1">
            <div class="row">
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- Place your label on the left -->
                            <label for="task">Task Label</label>
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


        </div>

    </div>

</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
