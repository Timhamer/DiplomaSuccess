document.addEventListener('DOMContentLoaded', function () {
    const showPopupButton = document.getElementById('showPopup');
    const popup = document.getElementById('popup');
    const saveButton = document.getElementById('saveButton');
    const closeButton = document.getElementById('closeButton');

    // Hide the popup by default
    popup.style.display = 'none';

    showPopupButton.addEventListener('click', function () {
        popup.style.display = 'block';
    });

    closeButton.addEventListener('click', function () {
        // Close the popup when the "Close" button is clicked
        popup.style.display = 'none';
    });

    saveButton.addEventListener('click', function () {
        // Handle save logic here
        popup.style.display = 'none';
    });
});
