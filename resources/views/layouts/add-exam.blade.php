<script src="{{ asset('js/add-exam.js') }}"></script>


<div class="container mt-5">
    <div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="popupLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popupLabel">Examen toevoegen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('examenToevoegen') }}">
                        @csrf

                        <div class="form-group">
                            {{-- Courses dropdown --}}
                            <label for="opleiding">Opleiding</label>
                            <select class="form-control" id="courses" name="selected_course">
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            {{-- Docenten dropdown --}}
                            <label for="examinator">Examinator</label>
                            <select class="form-control" id="docenten" name="selected_teachers[]" multiple>
                                @foreach($docenten as $docent)
                                    <option
                                        value="{{ $docent->id }}">{{ $docent->first_name . ' ' . $docent->middle_name . ' ' . $docent->last_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="saveButton">Opslaan</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
