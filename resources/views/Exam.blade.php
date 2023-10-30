<!DOCTYPE html>
<html>
<head>
    <title>Studenten dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="card-header" data-toggle="collapse" data-target="#user-1">
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
        <div class="card-header" data-toggle="collapse" data-target="#user-1-1">
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
            <div class="card-header" data-toggle="collapse" data-target="#user-1-1-1">
                <div class="row">
                    <div class="col-sm-11">
                        <label>Examen</label>
                    </div>
                    <div class="col-sm-1">
                        <label>v</label>
                    </div>
                </div>
            </div>

            <div class="collapse" id="user-1-1-1">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-8">
                            <label>Opleiding</label>
                        </div>
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-primary viewexambtn" data-toggle="modal" data-target="#exam-1">Bekijk examen</button>
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
