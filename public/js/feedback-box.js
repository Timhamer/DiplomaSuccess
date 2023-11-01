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
        // Send feedback to server using normal JS.
        fetch('/feedback', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({feedback: text})
        }).then(function (response) {
            if (response.status === 200) {
                Feedback('Feedback verzonden', 'success')
            } else {
                Feedback('Feedback niet verzonden', 'error')
            }
            })
        }
    else
        {
            Feedback('Geen feedback ingevoerd', 'error')
        }
    }
