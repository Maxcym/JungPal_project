// Print the profil information in the profile page
document.addEventListener("DOMContentLoaded", function() {
// Retrieving profile information when the page is loaded
    fetch('https://elderly-companions.azurewebsites.net/php/profile.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Injecting profile data into the DOM

                document.getElementById('name').textContent = data.name;
                document.getElementById('surname').textContent = data.surname;
                document.getElementById('part').value = data.party || '';
                document.getElementById('gard').value = data.garden || '';
                document.getElementById('clean').value = data.cleaning || '';
                document.getElementById('rooms').value = data.rooms || '';
                document.getElementById('price').value = data.price || '';
                document.getElementById('size').value = data.size || '';
                document.getElementById('connexion').value = data.internet || '';
                document.getElementById('dep').value = data.deposit || '';
                document.getElementById('Camp').value = data.campus_time || '';
            } else {
                alert("Erreur: " + data.message);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur de connexion au serveur.');
        });
});