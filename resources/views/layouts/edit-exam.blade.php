@extends('layouts.app')

@section('content')
    <form id="dynamic-form" action="{{ route('saveFormData') }}" method="POST">
        @csrf
        <div id="form-container">
            <div id="kerntaak-container">
                @foreach($courses[0]->coretasks as $coretask)
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
                                        <input value="{{$workprocess->name}}">
                                    </div>
                                    <div class="col-sm-1">
                                        <label>v</label>
                                    </div>
                                </div>
                            </div>

                            <div class="collapse" id="workprocess-{{$workprocess->id}}">
                                @foreach($workprocess->tasks as $task)
                                    <div class="row taak">
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input value="{{$task->name}}">
                                                </div>
                                                <div class="col-sm-6">
                                                    @if ($task->type == 1)
                                                        <div class="btn-group threeopt-radio" data-toggle="buttons">
                                                            <label class="btn">
                                                                <input type="radio" name="options" class="task-option" value="0" disabled>0
                                                            </label>
                                                            <label class="btn">
                                                                <input type="radio" name="options" class="task-option" value="1" disabled>1
                                                            </label>
                                                            <label class="btn">
                                                                <input type="radio" name="options" class="task-option" value="2" disabled>2
                                                            </label>
                                                            <label class="btn">
                                                                <input type="radio" name="options" class="task-option" value="3" disabled>3
                                                            </label>
                                                        </div>
                                                    @elseif ($task->type == 0)
                                                        <div class="btn-group threeopt-radio" data-toggle="buttons">
                                                            <label class="btn">
                                                                <input type="radio" name="options" class="task-option" value="0" disabled>Nee
                                                            </label>
                                                            <label class="btn">
                                                                <input type="radio" name="options" class="task-option" value="1" disabled>Ja
                                                            </label>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <button type="button" id="add-kerntaak-button" class="btn btn-primary mt-2">Kerntaak +</button>
            </div>
        </div>
        <button type="submit" id="save-button" class="btn btn-success mt-2">Save</button> <!-- Add "Save" button -->
    </form>
    <div id="total-value-container">
        <!-- Display the total value here -->
    </div>
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
            visibility: visible;
        }

        .werkproces-container {
            margin: 5px;
        }

        .taak-container {
            margin: 5px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
       $(document).ready(function () {
            let showFirstSet = true;
            let kerntaakContainer = $('#kerntaak-container');

            function generateUniqueId(prefix, counter) {
                counter++;
                return `${prefix}-${counter}`;
            }

            function toggleRadioButtons(radioButtons, showFirstSet) {
                radioButtons.empty();

                if (showFirstSet) {
                    radioButtons.append(`
                    <label>
                        <input type="radio" name="input" value="0" disabled> 1
                    </label>
                    <label>
                        <input type="radio" name="input" value="1" disabled> 2
                    </label>
                    <label>
                        <input type="radio" name="input" value="2" disabled> 3
                    </label>
                    <label>
                        <input type="radio" name="input" value="3" disabled> 4
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
            function updateTotalValueInputs(totalValue, container, werkprocesId) {
                container.empty();  // Clear previous inputs
                const firstInputId = `total-value-${werkprocesId}-${0}`;

                const firstElement = `
                        <label for="${firstInputId}">${0} punt:</label>
                        <input type="text" id="${firstInputId}" name="${firstInputId}" value="1">
                        <br>
                    `;
                    container.append(firstElement);
                for (let i = 0; i < totalValue; i++) {
                    const inputId = `total-value-${werkprocesId}-${i + 1}`;
                    const value = (i+1)/totalValue*9+1;
                    const inputElement = `
                        <label for="${inputId}">${i + 1} punt:</label>
                        <input type="text" id="${inputId}" name="${inputId}" value="${value}">
                        <br>
                    `;
                    container.append(inputElement);
                }
            }

            function calculateTotalValue(werkprocesRow) {
                let totalValue = 0;

                const cijferContainer = werkprocesRow.find('.cijfer-container');
                werkprocesRow.find('.taak-row').each(function (index) {
                    const type = parseInt($(this).find('input[name^="type"]').val());
                    totalValue += type === 0 ? 3 : 1;
                });

                // Pass the Werkproces div's unique identifier to updateTotalValueInputs
                updateTotalValueInputs(totalValue, cijferContainer, werkprocesRow.attr('id'));

                return totalValue;
            }

            // Initial creation of the total value inputs

            function updateTotalValue() {
                let totalValue = 0;
                kerntaakContainer.find('.werkproces-row').each(function () {
                    totalValue += calculateTotalValue($(this));
                });
            }

            function addWerkprocesRow(kerntaakRow, werkprocesCounter, gradeCounter) {
                const werkprocesContainer = $("<div class='werkproces-container'></div>");
                const newWerkproces = $(`<div class='werkproces-row' id="${generateUniqueId('werkproces', werkprocesCounter)}"></div>`);
                const taakRow = $("<div class='taak-row'>");

                // Get the radio count
                const radioCount =  countRadioInputs(newWerkproces);
                console.log(radioCount);

                // Add text inputs for "grade" based on radioCount
                let gradeInputs = "";

                for (let i = 0; i < radioCount; i++) {
                    gradeInputs += `
                        <input type="number" name="grade-${generateUniqueId()}" placeholder="Grade">
                    `;
                }

                newWerkproces.append(`

                            <div class="card-header werkproces-header" data-toggle="collapse"
                                 data-target="#workprocess-{{$workprocess->id}}">
                                <div class="row">
                                    <div class="col-sm-11">
                                        <input value="{{$workprocess->name}}">
                                         <button type="button" class="add-taak-button btn btn-info">Taak +</button>
                    <button type="button" class="delete">Delete</button>
                                    </div>
                                    <div class="col-sm-1">
                                        <label>v</label>
                                    </div>
                                </div>
                            </div>

                    <div class="taak-container"></div>
                `);
                werkprocesContainer.append(newWerkproces);
                kerntaakRow.append(werkprocesContainer);

                // Add "Taak +" button click event for the new "Werkproces" row
                newWerkproces.find('.add-taak-button').on("click", function () {
                    addTaakRow(newWerkproces);
                    updateTotalValue();
                });

                // Add a click event for the delete button
                newWerkproces.on("click", ".delete", function () {
                    werkprocesContainer.remove();
                    updateTotalValue();
                });
            }

            function addTaakRow(werkprocesRow, taakCounter, typeCounter, crucialCounter) {
                const taakContainer = werkprocesRow.find('.taak-container');

                const newTaak = $(`<div class='taak-row'></div>`);
                newTaak.append(`
                    <input type="text" name="taak-${generateUniqueId('taak', taakCounter)}[]" placeholder="Taak">
                    <input type="hidden" name="type-${generateUniqueId('type', typeCounter)}" value="0">

 <div class="row taak">
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input value="{{$task->name}}">
                                                </div>
                                                <div class="col-sm-6">
                                                    @if ($task->type == 1)
                <div class="btn-group threeopt-radio" data-toggle="buttons">
                    <label class="btn">
                        <input type="radio" name="options" class="task-option" value="0" disabled>0
                    </label>
                    <label class="btn">
                        <input type="radio" name="options" class="task-option" value="1" disabled>1
                    </label>
                    <label class="btn">
                        <input type="radio" name="options" class="task-option" value="2" disabled>2
                    </label>
                    <label class="btn">
                        <input type="radio" name="options" class="task-option" value="3" disabled>3
                    </label>
                </div>
@elseif ($task->type == 0)
                <div class="btn-group threeopt-radio" data-toggle="buttons">
                    <label class="btn">
                        <input type="radio" name="options" class="task-option" value="0" disabled>Nee
                    </label>
                    <label class="btn">
                        <input type="radio" name="options" class="task-option" value="1" disabled>Ja
                    </label>
                </div>
@endif
                </div>
            </div>
        </div>
    </div>

                    <input type="text" name="description-${generateUniqueId()}[]" placeholder="Beschrijving">
                    <button type="button" class="switch">Type</button>
                    <button type="button" class="delete">Delete</button>
                    <div class="radio-buttons">
                        <label>
                            <input type="radio" name="input" value="0" disabled> 0
                        </label>
                        <label>
                            <input type="radio" name="input" value="1" disabled> 1
                        </label>
                        <label>
                            <input type="radio" name="input" value="2" disabled> 2
                        </label>
                        <label>
                            <input type="radio" name="input" value="3" disabled> 3
                        </label>
                    </div>
                    <label> Cruciaal
                        <input type="checkbox" name="crucial-${generateUniqueId()}" id="crucial">
                    </label>
                `);
                taakContainer.append(newTaak);

                newTaak.find('.switch').on("click", function () {
                    const typeInput = newTaak.find('input[name^="type"]');
                    const currentType = parseInt(typeInput.val());

                    // Toggle between 0 and 1
                    const newType = currentType === 0 ? 1 : 0;

                    // Update the hidden input with the new type value
                    typeInput.val(newType);

                    // Update the radio buttons visibility
                    showFirstSet = !showFirstSet;
                    toggleRadioButtons(newTaak.find('.radio-buttons'), showFirstSet);

                    // Update the total value
                    updateTotalValue();
                });
                // Add a click event for the delete button
                newTaak.on("click", ".delete", function () {
                    newTaak.remove();
                    updateTotalValue();
                });
            }

            // Add a "Kerntaak +" button click event
            $('#add-kerntaak-button').on("click", function () {
                const newKerntaak = $("<div class='kerntaak-row'></div>");
                newKerntaak.append(`
                    <div class='kerntaak-header'>
                        <div class="card-header kerntaak-header" data-toggle="collapse" data-target="#kerntaak-{{$coretask->id}}">
                        <div class="row">
                            <div class="col-sm-11">
                                <label>Kerntaak</label>
                            </div>
                            <div class="col-sm-1">
                                <label>v</label>
                            </div>
                        </div>
                    </div><button type='button' class='add-werkproces-button btn btn-secondary'>Werkproces +</button>
                        <button type="button" class="delete">Delete</button>
                    </div>
                `);

                let werkprocesCounter = 0;
                let gradeCounter = 0;
                newKerntaak.find('.add-werkproces-button').on("click", function () {
                    addWerkprocesRow(newKerntaak, werkprocesCounter++, gradeCounter++);
                });

                newKerntaak.on("click", ".delete", function () {
                    newKerntaak.remove();
                    updateTotalValue();
                });

                kerntaakContainer.append(newKerntaak);

                // Add a click event for the delete button
                newKerntaak.on("click", ".delete", function () {
                    newKerntaak.remove(); // Delete the Kerntaak row
                });
            });
        });
    </script>
@endpush
