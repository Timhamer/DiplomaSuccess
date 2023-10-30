document.addEventListener('DOMContentLoaded', function () {
    const showCoursePopupButton = document.getElementById('showCoursePopup');
    const saveCourseButton = document.getElementById('saveCourseButton');

    showCoursePopupButton.addEventListener('click', function () {
        $('#coursePopup').modal('show'); // Use Bootstrap modal to show the popup
    });

    saveCourseButton.addEventListener('click', function () {
        // Handle save logic here
        $('#coursePopup').modal('hide'); // Use Bootstrap modal to hide the popup
    });
});
