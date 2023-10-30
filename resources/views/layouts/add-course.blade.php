<script src="{{ asset('js/add-course.js') }}"></script>


<div class="container mt-5">
    <div class="modal fade" id="coursePopup" tabindex="-1" role="dialog" aria-labelledby="coursePopupLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="coursePopupLabel">Opleiding toevoegen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('opleidingToevoegen') }}">
                        @csrf

                        <div class="form-group">
                            <input type="text" class="courseName" id="courseName" name="courseName" placeholder="Naam">
                            <input type="number" class="crebo" id="crebo" name="crebo" placeholder="Crebo">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="saveCourseButton">Opslaan</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
