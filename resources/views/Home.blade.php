@extends('layouts.app')

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bootstrap Rows of Divs</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function Feedback(Message, Type) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: Type,
                title: Message
            })
        }

        async function ConfirmBox() {
            const {value: accept} = await Swal.fire({
                title: "<strong>Weet je zeker dat je het examen in wilt zien?</strong>",
                icon: "warning",
                html: `
                    Als je verder gaat dan ga je akkoord met de <a href="/terms">algemene voorwaarden</a>. <br>
                    <b>Je kunt niet meer terug na dit punt.</b>
                  `,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: `
                    Examen inzien
                  `,
                cancelButtonText: `
                    Annuleren
                  `
            });

            if (accept) {
                $.ajax({
                    type: 'POST',
                    url: '/see_exam',
                    data: {
                        _token: '{{csrf_token()}}',
                        'exam_id': 1
                    },
                    success: function (data) {
                        if (data.success === true) {
                            console.log(data)
                        } else {
                            Feedback('Server error bij inzien van examen', 'error')
                        }
                    },
                    error: function (data) {
                        Feedback('Client error bij inzien van examen', 'error')
                    }
                })
            } else {
                Feedback('Examen inzien geannuleerd', 'info')
            }
        }

        async function FeedbackBox() {
            const {value: text} = await Swal.fire({
                input: 'textarea',
                inputLabel: 'Feedback',
                inputPlaceholder: 'Typ je feedback hier...',
                inputAttributes: {
                    'aria-label': 'Type je feedback hier'
                },
                showCancelButton: true,

                cancelButtonText: 'Annuleren',
                confirmButtonText: 'Verzenden'
            })

            if (text) {
                console.log(text)
                $.ajax({
                    type: 'POST',
                    url: '/feedback',
                    data: {
                        _token: '{{csrf_token()}}',
                        'feedback': text,
                        'workprocess_id': 1,
                        'exam_id': 1
                    },
                    success: function (data) {
                        if (data.success === true) {
                            Feedback('Feedback verzonden', 'success')
                        } else {
                            Feedback('Feedback niet verzonden', 'error')
                        }
                    },
                    error: function (data) {
                        Feedback('Feedback niet verzonden', 'error')
                    }
                })
            } else {
                Feedback('Geen feedback ingevoerd', 'error')
            }
        }

    </script>
</head>
@section('content')

    <body>
    @foreach ($exams as $exam)
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="my-3 p-3 bg-light">
                        <div class="row">
                            <div class="col-9">
                                <h4>{{ $exam->course->name }}</h4>
                            </div>
                            <div class="col-3">
                                <a href="{{ route('Examine', ['id' => $exam->course->id]) }}">

                                    <button class="btn btn-primary">Bekijk</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <button class="btn btn-primary" onclick="ConfirmBox()">Confirm knop</button>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
@endsection
