@extends('layouts.app')

@section('content')
    <form id="dynamic-form" action="{{ route('saveFormData') }}" method="POST">
        @csrf
        <div id="form-container">
            <div id="kerntaak-container">
                @foreach ($courses[0]->coretasks as $coretask)
                    <div class="card-header kerntaak-header" data-toggle="collapse"
                        data-target="#kerntaak-{{ $coretask->id }}">
                        <div class="row">
                            <div class="col-sm-11">
                                <label>Kerntaak</label>
                            </div>
                            <div class="col-sm-1">
                                <label>v</label>
                            </div>
                        </div>
                    </div>

                    <div class="collapse" id="kerntaak-{{ $coretask->id }}">
                        @foreach ($coretask->workprocesses as $workprocess)
                            <div class="card-header werkproces-header" data-toggle="collapse"
                                data-target="#workprocess-{{ $workprocess->id }}">
                                <div class="row">
                                    <div class="col-sm-11">
                                        <input value="{{ $workprocess->name }}">
                                    </div>
                                    <div class="col-sm-1">
                                        <label>v</label>
                                    </div>
                                </div>
                            </div>

                            <div class="collapse" id="workprocess-{{ $workprocess->id }}">
                                @foreach ($workprocess->tasks as $task)
                                    <div class="row taak">
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input value="{{ $task->name }}">
                                                </div>
                                                <div class="col-sm-6">
                                                    @if ($task->type == 1)
                                                        <div class="btn-group threeopt-radio" data-toggle="buttons">
                                                            <label class="btn">
                                                                <input type="radio" name="options" class="task-option"
                                                                    value="0" disabled>0
                                                            </label>
                                                            <label class="btn">
                                                                <input type="radio" name="options" class="task-option"
                                                                    value="1" disabled>1
                                                            </label>
                                                            <label class="btn">
                                                                <input type="radio" name="options" class="task-option"
                                                                    value="2" disabled>2
                                                            </label>
                                                            <label class="btn">
                                                                <input type="radio" name="options" class="task-option"
                                                                    value="3" disabled>3
                                                            </label>
                                                        </div>
                                                    @elseif ($task->type == 0)
                                                        <div class="btn-group threeopt-radio" data-toggle="buttons">
                                                            <label class="btn">
                                                                <input type="radio" name="options" class="task-option"
                                                                    value="0" disabled>Nee
                                                            </label>
                                                            <label class="btn">
                                                                <input type="radio" name="options" class="task-option"
                                                                    value="1" disabled>Ja
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
        /* Add your styles here */
    </style>
    <script>
       $(document).ready(function () {
            let showFirstSet = true;
            let kerntaakContainer = $('#kerntaak-container');

            function generateUniqueId(prefix, counter) {
                counter++;
                return `${prefix}-${counter}`;
            }

            function toggleRadioButtons(radioButtons, showFirstSet) {
                // ... (unchanged)
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
                newWerkproces.append(`
                    <input type="text" name="werkproces-${generateUniqueId('werkproces', werkprocesCounter)}[]" placeholder="Werkproces">
                    <input type="number" name="grade-${generateUniqueId('grade', gradeCounter)}" placeholder="cijfer">
                    <button type="button" class="add-taak-button btn btn-info">Taak +</button>
                    <button type="button" class="delete">Delete</button>
                    <div class="taak-container">
                        <!-- Initially, no Taak rows are visible -->
                    </div>
                    <div class="cijfer-container">
                        <!-- Initially, no Taak rows are visible -->
                    </div>
                `);
                werkprocesContainer.append(newWerkproces);
                kerntaakRow.append(werkprocesContainer);

                newWerkproces.find('.add-taak-button').on("click", function () {
                    addTaakRow(newWerkproces);
                    updateTotalValue();
                });

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
                    <button type="button" class="switch">Type</button>
                    <button type="button" class="delete">Delete</button>
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
                    <label>
                        Cruciaal
                        <input type="checkbox" name="crucial-${generateUniqueId('crucial', crucialCounter)}" id="crucial">
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

                newTaak.on("click", ".delete", function () {
                    newTaak.remove();
                    updateTotalValue();
                });
            }

            $('#add-kerntaak-button').on("click", function () {
                const newKerntaak = $("<div class='kerntaak-row'></div>");
                newKerntaak.append(`
                    <div class='kerntaak-header'>
                        <input type='text' name="kerntaak-${generateUniqueId('kerntaak', 0)}[]" placeholder='Kerntaak'>
                        <button type='button' class='add-werkproces-button btn btn-secondary'>Werkproces +</button>
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
            });
        });
    </script>
@endpush

