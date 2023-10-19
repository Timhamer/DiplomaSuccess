
<script src="{{ asset('js/popup.js') }}"></script>

<div class="container mt-5">
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
