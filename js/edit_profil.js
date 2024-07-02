document.addEventListener("DOMContentLoaded", function() {
    // Charger les informations de profil lorsque la page est chargée
    fetch('http://localhost/JungPal_project/php/profile.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Injecter les données du profil dans le formulaire
                document.getElementById('nom').value = data.name;
                document.getElementById('prenom').value = data.surname;
                document.getElementById('Gdr').value = data.gender;
                document.getElementById('birth').value = data.birth_date;
                document.getElementById('Addr').value = data.address;
                document.getElementById('Cty').value = data.city;
                document.getElementById('pc').value = data.postal_code;
                document.getElementById('email').value = data.email;
                document.getElementById('password').value = data.password;
                document.getElementById('confirm-password').value = data.password;
            } else {
                alert("Erreur: " + data.message);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur de connexion au serveur.');
        });

    // Soumettre les modifications
    document.getElementById('modify').addEventListener('click', function(event) {
        event.preventDefault();
        let formData = new FormData(document.getElementById('inscription-form'));

        fetch('http://localhost/JungPal_project/php/update_profile.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Les informations de profil ont été mises à jour avec succès.");
                document.querySelectorAll('input').forEach(input => input.disabled = true);
            } else {
                alert("Erreur: " + data.message);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur de connexion au serveur.');
        });
    });
});
