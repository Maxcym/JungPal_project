/**
 * Adds a photo to the specified container.
 *
 * This function takes the ID of a file input element and the ID of a container element.
 * It reads the first selected file from the input, creates an image element with a unique ID,
 * sets its source to the file's data URL, clears any existing content in the container, and
 * appends the new image to the container.
 *
 */
function addPhoto(inputId, containerId) {
    var input = document.getElementById(inputId);
    var file = input.files[0];
    var reader = new FileReader();

    reader.onload = function(e) {
        var image = document.createElement('img');
        var timestamp = new Date().getTime();
        image.id = 'image_' + timestamp;
        image.src = e.target.result;
        var container = document.getElementById(containerId);
        container.innerHTML = '';
        container.appendChild(image);
    };

    reader.readAsDataURL(file);
}
