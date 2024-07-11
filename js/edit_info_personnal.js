// Function to unlock inputs
function unlockInputs() {
    var inputs = document.querySelectorAll('#inscription-form input');
    inputs.forEach(function(input) {
        input.disabled = false;
    });
    document.getElementById('unlock').style.display = 'none';
    document.getElementById('lockButton').style.display = 'inline-block';
}

// Function to lock inputs
function lockInputs() {
    var inputs = document.querySelectorAll('#inscription-form input');
    inputs.forEach(function(input) {
        input.disabled = true;
    });
    document.getElementById('unlock').style.display = 'inline-block';
    document.getElementById('lockButton').style.display = 'none';
}


document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('unlock').addEventListener('click', unlockInputs);
    document.getElementById('lockButton').addEventListener('click', lockInputs);
});
