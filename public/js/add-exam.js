 document.addEventListener('DOMContentLoaded', function () {
    const showPopupButton = document.getElementById('showPopup');
    const saveButton = document.getElementById('saveButton');

    showPopupButton.addEventListener('click', function () {
    $('#popup').modal('show'); // Use Bootstrap modal to show the popup
});

    saveButton.addEventListener('click', function () {
    // Handle save logic here
    $('#popup').modal('hide'); // Use Bootstrap modal to hide the popup
});
});
