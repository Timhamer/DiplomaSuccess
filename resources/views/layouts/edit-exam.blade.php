@extends('layouts.app')
<!-- Add these lines to include Bootstrap CSS and JavaScript files -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@section('content')
    @csrf
    <div id="form-container">
        <div id="kerntaak-container">


        </div>
        <button type="button" id="add-kerntaak-button" class="btn btn-primary mt-2">Kerntaak +</button>
    </div>
    <button type="submit" id="save-button" class="btn btn-success mt-2">Save</button> <!-- Add "Save" button -->
    <div id="total-value-container">
        <!-- Display the total value here -->
    </div>
@endsection
<?php
$phpObject = $courses[0]->coretasks;
$jsonString = json_encode($phpObject);
?>
@push('scripts')
    <style>
        /* Add your styles here */
    </style>
    <script>
        $(document).ready(function() {
            $('.kerntaak-header').on('click', function() {
                var targetId = $(this).data('target');
                $(targetId).collapse('toggle');
            });

            $('.task-option').on('click', function() {
                var selectedValue = $(this).val();
                var examId = $(this).data('exam-id');
                var taskId = $(this).data('task-id');

                $.ajax({
                    type: 'POST',
                    url: this.getAttribute(
                        'data-route'
                        ), // Update the URL to the route that will handle the submission
                    data: {
                        _token: '{{ csrf_token() }}',
                        exam_id: examId,
                        task_id: taskId,
                        selected_value: selectedValue
                    },
                    success: function(response) {
                        // Handle success response if needed
                    },
                    error: function(xhr) {
                        // Handle error response if needed
                    }
                });
            });


            let showFirstSet = true;
            let kerntaakContainer = $("#kerntaak-container");

            function generateUniqueId(prefix, counter) {
                counter++;
                return `${prefix}-${counter}`;
            }

            function toggleRadioButtons(radioButtons, showFirstSet) {
                radioButtons.empty();

                if (showFirstSet) {
                    radioButtons.append(`
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

            function updateTotalValueInputs(totalValue, container, werkprocesId) {
                container.empty(); // Clear previous inputs
                const firstInputId = `total-value-${werkprocesId}-${0}`;

                const firstElement = `
                        <label for="${firstInputId}">${0} punt:</label>
                        <input type="text" id="${firstInputId}" name="${firstInputId}" value="1">
                        <br>
                    `;
                container.append(firstElement);
                for (let i = 0; i < totalValue; i++) {
                    const inputId = `total-value-${werkprocesId}-${i + 1}`;
                    const value = (i + 1) / totalValue * 9 + 1;
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
                werkprocesRow.find('.taak-row').each(function(index) {
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
                kerntaakContainer.find('.werkproces-row').each(function() {
                    totalValue += calculateTotalValue($(this));
                });
            }

            function addWerkprocesRow(kerntaakRow, workProces) {
                const werkprocesContainer = $("<div class='werkproces-container'></div>");
                const newWerkproces = $(`<div class='werkproces-row' id="workProces-${workProces.id}}"></div>`);
                newWerkproces.append(`
        <div class="card-header werkproces-header" data-toggle="collapse"
             data-target="#workprocess-${workProces.id}">
            <div class="row">
                <div class="col-sm-11">
                    <input id='wpinput-${workProces.id}' value='${workProces.name}'>
                    <input id='wpcinput-${workProces.id}' value='${workProces.code}'>

                    <button type='button' class='add-task-button btn btn-secondary'>Taak +</button>
                    <button type="button" class="delete">Delete</button>
                </div>
                <div class="col-sm-1">
                    <label>v</label>
                </div>
            </div>
        </div>
        <div class="collapse" id="workprocess-${workProces.id}">
        </div>
    `);
                workProces.tasks.forEach(function(task) {
                    addTaakRow(newWerkproces, task);
                });

                werkprocesContainer.append(newWerkproces);

                kerntaakRow.find('#kerntaak-' + workProces.coretask_id).append(werkprocesContainer);

                newWerkproces.find('.add-task-button').on("click", function() {
                    $.ajax({
                        type: 'POST',
                        url: 'saveTask', // Update the URL to the route that will handle the submission
                        data: {
                            _token: '{{ csrf_token() }}',
                            workproces_id: workProces.id,
                            name: 'Test',
                            crucial: 1,
                            type: 1,
                            description: 'tekst',
                            zero: 'zero',
                            one: 'one',
                            two: 'two',
                            three: 'three'
                        },
                        success: function(response) {
                            addTaakRow(newWerkproces, response["task"]);


                        },
                        error: function(xhr) {
                            // Handle error response if needed
                        }
                    });
                    // addTaakRow(newWerkproces);
                    updateTotalValue();
                });

                newWerkproces.on("click", ".delete", function() {

                    werkprocesContainer.remove();
                    $.ajax({
                        type: 'POST',
                        url: 'deleteWorkproces', // Update the URL to the route that will handle the submission
                        data: {
                            _token: '{{ csrf_token() }}',
                            workproces_id: workProces.id,
                        },
                        success: function(response) {
                            // Handle success response if needed
                            // addWerkprocesRow(newKerntaak, response);
                        },
                        error: function(xhr) {
                            // Handle error response if needed
                        }
                    });

                    updateTotalValue();
                });

                function updateWerkproces() {
                    const name = newWerkproces.find('#wpinput-' + workProces.id).val();
                    const code = newWerkproces.find('#wpcinput-' + workProces.id).val();
                    $.ajax({
                        type: 'POST',
                        url: 'updateWorkproces',
                        data: {
                            _token: '{{ csrf_token() }}',
                            workproces_id: workProces.id,
                            name: name,
                            code: code
                        },
                        success: function(response) {

                        },
                        error: function(xhr) {
                            // Handle error response if needed
                        }
                    });
                }
                newWerkproces.find('#wpinput-' + workProces.id).on('blur', function() {
                    updateWerkproces();
                });
                newWerkproces.find('#wpcinput-' + workProces.id).on('blur', function() {
                    updateWerkproces();
                });
            }


            function addTaakRow(werkprocesRow, task) {
                const taakContainer = $("<div class='taak-container'></div>");
                const newTaak = $(`<div class='taak-row' id="taak-${task.id}}"></div>`);
                newTaak.append(`

                <div class="card-header task-header" data-toggle="collapse"
             data-target="#task-${task.id}">
            <div class="row">
                <div class="col-sm-11">
                    <input id='tninput-${task.id}' value='${task.name}'>
                    <button type="button" class="delete">Delete</button>
                </div>
                <div class="col-sm-1">
                    <label>v</label>
                </div>
            </div>
        </div>
        <div class="collapse" id="task-${task.id}">
        </div>


        `);
                // <div class="row taak">
                //     <div class="col-sm-10">
                //         <div class="row">
                //             <div class="col-sm-6">
                //                 <input value=" ${$task.name}">
                //                 <button type="button" class="switch">Type</button>
                //                 <button type="button" class="delete">Delete</button>
                //             </div>
                //                 <div class="col-sm-6">
                //
                //                         <div class="btn-group threeopt-radio" data-toggle="buttons">
                //                             <label class="btn">
                //                                 <input type="radio" name="options" class="task-option" value="0" disabled>0
                //                              </label>
                //                             <label class="btn">
                //                                 <input type="radio" name="options" class="task-option" value="1" disabled>1
                //                             </label>
                //                             <label class="btn">
                //                                 <input type="radio" name="options" class="task-option" value="2" disabled>2
                //                             </label>
                //                             <label class="btn">
                //                                 <input type="radio" name="options" class="task-option" value="3" disabled>3
                //                             </label>
                //                         </div>
                //
                //                         <div class="btn-group threeopt-radio" data-toggle="buttons">
                //                             <label class="btn">
                //                                 <input type="radio" name="options" class="task-option" value="0" disabled>Nee
                //                             </label>
                //                             <label class="btn">
                //                                 <input type="radio" name="options" class="task-option" value="1" disabled>Ja
                //                             </label>
                //                         </div>
                //
                //                 </div>
                //             </div>
                //         </div>
                //     </div>
                taakContainer.append(newTaak);
                werkprocesRow.find('#workprocess-' + task.workprocess_id).append(taakContainer);

                // newTaak.find('.switch').on("click", function() {
                //     const typeInput = newTaak.find('input[name^="type"]');
                //     const currentType = parseInt(typeInput.val());

                //     // Toggle between 0 and 1
                //     const newType = currentType === 0 ? 1 : 0;

                //     // Update the hidden input with the new type value
                //     typeInput.val(newType);

                //     // Update the radio buttons visibility
                //     showFirstSet = !showFirstSet;
                //     toggleRadioButtons(newTaak.find('.radio-buttons'), showFirstSet);

                //     // Update the total value
                //     updateTotalValue();
                // });

                newTaak.on("click", ".delete", function() {
                    newTaak.remove();
                    $.ajax({
                        type: 'POST',
                        url: 'deleteTask', // Update the URL to the route that will handle the submission
                        data: {
                            _token: '{{ csrf_token() }}',
                            task_id: task.id,
                        },
                        success: function(response) {
                            // Handle success response if needed
                            // addWerkprocesRow(newKerntaak, response);
                        },
                        error: function(xhr) {
                            // Handle error response if needed
                        }
                    });
                    updateTotalValue();
                });

                function updateTaak() {
                    const name = newTaak.find('#tninput-' + task.id).val();
                    $.ajax({
                        type: 'POST',
                        url: 'updateTask',
                        data: {
                            _token: '{{ csrf_token() }}',
                            task_id: task.id,
                            name: name,
                        },
                        success: function(response) {

                        },
                        error: function(xhr) {
                            // Handle error response if needed
                        }
                    });
                }

                newTaak.find('#tninput-' + task.id).on('blur', function() {
                    updateTaak();
                });
            }
            var jsObject = JSON.parse('<?php echo $jsonString; ?>');
            jsObject.forEach(function(jsObject) {
                addKerntaak(jsObject);
            });

            $('#add-kerntaak-button').on("click", function() {
                $.ajax({
                    type: 'POST',
                    url: 'saveCoretask', // Update the URL to the route that will handle the submission
                    data: {
                        _token: '{{ csrf_token() }}',
                        course_id: jsObject[0].course_id,
                        name: 'Name',
                        code: 'Code'
                    },
                    success: function(response) {
                        // Handle success response if needed
                        response["coretask"].workprocesses = []
                        addKerntaak(response["coretask"]);
                    },
                    error: function(xhr) {
                        // Handle error response if needed
                    }
                });

            });




            function addKerntaak(jsObject) {
                const newKerntaak = $("<div class='kerntaak-row'></div>");
                newKerntaak.append(`
                <div class="card-header kerntaak-header" data-toggle="collapse"
                        data-target="#kerntaak-${jsObject.id}" >
                        <div class="row">
                            <div class="col-sm-11">
                                <input id='ktinput-${jsObject.id}' value='${jsObject.name}'>
                                <input id='ktcinput-${jsObject.id}' value='${jsObject.code}'>

                                <button type='button' class='add-werkproces-button btn btn-secondary'>Werkproces +</button>
                                <button type="button" class="delete">Delete</button>
                            </div>
                            <div class="col-sm-1">
                                <label>v</label>
                            </div>
                        </div>
                        </div>
                        <div class="collapse" id="kerntaak-${jsObject.id}">
                            </div>
                `);
                jsObject.workprocesses.forEach(function(workProces) {
                    addWerkprocesRow(newKerntaak, workProces);
                });
                newKerntaak.find('.add-werkproces-button').on("click", function() {

                    $.ajax({
                        type: 'POST',
                        url: 'saveWorkproces', // Update the URL to the route that will handle the submission
                        data: {
                            _token: '{{ csrf_token() }}',
                            coretask_id: jsObject.id,
                            name: 'Hallowohfefbaifu',
                            code: 'W3'
                        },
                        success: function(response) {
                            // Handle success response if needed
                            response["workproces"].tasks = [];
                            addWerkprocesRow(newKerntaak, response["workproces"]);
                        },
                        error: function(xhr) {
                            // Handle error response if needed
                        }
                    });

                });
                newKerntaak.on("click", ".delete", function() {
                    newKerntaak.remove();
                    $.ajax({
                        type: 'POST',
                        url: 'deleteCoretask', // Update the URL to the route that will handle the submission
                        data: {
                            _token: '{{ csrf_token() }}',
                            coretask_id: jsObject.id,
                        },
                        success: function(response) {
                            // Handle success response if needed
                            // addWerkprocesRow(newKerntaak, response);
                        },
                        error: function(xhr) {
                            // Handle error response if needed
                        }
                    });


                    updateTotalValue();
                });


                function updateKerntaak() {
                    const name = newKerntaak.find('#ktinput-' + jsObject.id).val();
                    const code = newKerntaak.find('#ktcinput-' + jsObject.id).val();
                    $.ajax({
                        type: 'POST',
                        url: 'updateCoretask',
                        data: {
                            _token: '{{ csrf_token() }}',
                            coretask_id: jsObject.id,
                            name: name,
                            code: code
                        },
                        success: function(response) {
                            // Handle success response if needed
                        },
                        error: function(xhr) {
                            // Handle error response if needed
                        }
                    });
                }
                newKerntaak.find('#ktinput-' + jsObject.id).on('blur', function() {
                    updateKerntaak();
                });
                newKerntaak.find('#ktcinput-' + jsObject.id).on('blur', function() {
                    updateKerntaak();
                });

                kerntaakContainer.append(newKerntaak);

            };
        });
    </script>
@endpush
