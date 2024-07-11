function ajouterPhoto(inputId, containerId) {
    var input = document.getElementById(inputId);
    var file = input.files[0];
    var reader = new FileReader();

    reader.onload = function(e) {
        var image = document.createElement('img');
        var timestamp = new Date().getTime(); // Generate a unique ID
        image.id = 'image_' + timestamp; // Unique ID fro each pictures
        image.src = e.target.result;
        var container = document.getElementById(containerId);
        container.innerHTML = ''; // Delete the previous content
        container.appendChild(image);
    };

    reader.readAsDataURL(file);
}