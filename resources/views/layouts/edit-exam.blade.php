@extends('layouts.app')

@section('content')
    <form id="dynamic-form" action="{{ route('saveFormData') }}" method="POST">
        @csrf <!-- Add CSRF token -->
        <div id="form-container">
            <div id="kerntaak-container">
                <!-- Initially, no Kerntaak rows are visible -->
            </div>
        </div>
        <button type="button" id="add-kerntaak-button" class="btn btn-primary mt-2">Kerntaak +</button>
        <button type="submit" id="save-button" class="btn btn-success mt-2">Save</button> <!-- Add "Save" button -->
    </form>
@endsection

@push('scripts')
    <style>
    .switch {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
    }

    .switch:hover {
    background-color: #0056b3;
    }


    .radio-buttons input[type="radio"] {
    margin-right: 5px;
    }
    </style>
    <script>
        $(document).ready(function () {
            let showFirstSet = true;
            let kerntaakContainer = $('#kerntaak-container');
            let inputIdCounter = 0; // Initialize a counter for unique input IDs

            function generateUniqueId() {
                inputIdCounter++;
                return 'input-' + inputIdCounter; // Create a unique ID
            }

            function toggleRadioButtons(radioButtons, showFirstSet) {
                radioButtons.empty();

                if (showFirstSet) {
                    radioButtons.append(`
                    <label>
                        <input type="radio" name="input" value="1" disabled> 1
                    </label>
                    <label>
                        <input type="radio" name="input" value="2" disabled> 2
                    </label>
                    <label>
                        <input type="radio" name="input" value="3" disabled> 3
                    </label>
                    <label>
                        <input type="radio" name="input" value="4" disabled> 4
                    </label>
                `);
                } else {
                    radioButtons.append(`
                    <label>
                        <input type="radio" name="input" value="1" disabled> Ja
                    </label>
                    <label>
                        <input type="radio" name="input" value="0" disabled> Nee
                    </label>
                `);
                }
            }

            // Function to add a "Werkproces" row
            function addWerkprocesRow(kerntaakRow) {
                const werkprocesContainer = $("<div class='werkproces-container'></div>");
                const newWerkproces = $("<div class='werkproces-row'></div>");
                newWerkproces.append(`
                    <input type="text" name="werkproces-${generateUniqueId()}[]" placeholder="Werkproces">
                    <input type="number" name="grade-${generateUniqueId()}" placeholder="cijfer">
                    <button type="button" class="add-taak-button btn btn-info">Taak +</button>
                    <div class="taak-container">
                        <!-- Initially, no Taak rows are visible -->
                    </div>
                `);
                werkprocesContainer.append(newWerkproces);
                kerntaakRow.append(werkprocesContainer);

                // Add "Taak +" button click event for the new "Werkproces" row
                newWerkproces.find('.add-taak-button').on("click", function () {
                    addTaakRow(newWerkproces);
                });
            }

            // Function to add a "Taak" row
            function addTaakRow(werkprocesRow) {
                const taakContainer = werkprocesRow.find('.taak-container');
                const newTaak = $("<div class='taak-row'></div>");
                newTaak.append(`
                    <input type="text" name="taak-${generateUniqueId()}[]" placeholder="Taak">
                    <button type="button" class="switch">Type</button>
                    <div class="radio-buttons">
                        <label>
                        <input type="radio" name="input" value="1" disabled> 1
                    </label>
                    <label>
                        <input type="radio" name="input" value="2" disabled> 2
                    </label>
                    <label>
                        <input type="radio" name="input" value="3" disabled> 3
                    </label>
                    <label>
                        <input type="radio" name="input" value="4" disabled> 4
                    </label>
                    </div>
<label> Cruciaal
<input type="checkbox" name="crucial-${generateUniqueId()}" id="crucial">
 </label>
                `);
                taakContainer.append(newTaak);

                // Add "Switch" button click event for the new "Taak" row
                newTaak.find('.switch').on("click", function () {
                    showFirstSet = !showFirstSet;
                    toggleRadioButtons(newTaak.find('.radio-buttons'), showFirstSet);
                });
            }

            // Add a "Kerntaak +" button click event
            $('#add-kerntaak-button').on("click", function () {
                const newKerntaak = $("<div class='kerntaak-row'></div>");
                newKerntaak.append(`
                    <div class='kerntaak-header'>
                        <input type='text' name="kerntaak-${generateUniqueId()}[]" placeholder='Kerntaak'>
                        <button type='button' class='add-werkproces-button btn btn-secondary'>Werkproces +</button>
                    </div>
                `);

                // Add "Werkproces +" button click event for this new "Kerntaak" row
                newKerntaak.find('.add-werkproces-button').on("click", function () {
                    addWerkprocesRow(newKerntaak);
                });

                kerntaakContainer.append(newKerntaak);
            });
        });
    </script>
@endpush
