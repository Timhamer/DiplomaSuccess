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
<<<<<<< Updated upstream
        // Check if text is not empty
    $.ajax({
        type: 'POST',
        url: '/feedback', // Update the URL to your feedback endpoint
        contentType: 'application/json',
        data: JSON.stringify({ feedback: text }),
        success: function(response) {
            if (response.status === 200) {
                Feedback('Feedback verzonden', 'success');
            } else {
                Feedback('Feedback niet verzonden', 'error');
            }
        },
        error: function() {
            Feedback('Feedback niet verzonden', 'error');
        }
    });
} else {
    Feedback('Geen feedback ingevoerd', 'error');
}}

=======
        // Send to server using ajax
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $.ajax({
            type: 'POST',
            url: '/feedback',
            data: {
                // Add the csrf token
                'X-CSRFToken': csrftoken,
                'feedback': text
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
>>>>>>> Stashed changes
