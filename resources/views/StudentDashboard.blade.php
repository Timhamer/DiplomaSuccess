<!DOCTYPE html>
<html>
<head>
    <title>Popup Example</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <button class="btn btn-primary" id="showPopup">Show Popup</button>

    <div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="popupLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popupLabel">Popup with Dropdowns</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
{{--                            Courses dropdown--}}
                            <label for="dropdown1">Dropdown 1</label>
                            <select class="form-control" id="courses">
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
{{--                            Docenten drowpdown--}}
                            <label for="dropdown2">Dropdown 2</label>
                            <select class="form-control" id="dropdown2">


                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveButton">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS (jQuery and Popper.js are required for Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const showPopupButton = document.getElementById('showPopup');
        const saveButton = document.getElementById('saveButton');

        showPopupButton.addEventListener('click', function () {
            $('#popup').modal('show'); // Use Bootstrap modal to show the popup
        });

        saveButton.addEventListener('click', function () {
            // Handle save logic here
            $('#popup').modal('hide'); // Use Bootstrap modal to hide the popup
        });
    });
</script>
</body>
</html>
