// If the user logs in succesfully, he is redirect to the right page
document.getElementById("login").addEventListener("click", function(event) {
    event.preventDefault();

    let formData = new FormData(document.querySelector("form"));

    ajaxRequest("POST", "http://localhost/JungPal_project/php/login.php", formData, function(response) {
        if (response.success) {
            // Rediriger vers la page d'accueil en cas de succès
            window.location.href = "http://localhost/JungPal_project/html/homepage_connected.html";
            alert(response.message);
        } else {
            // Afficher le message d'erreur en cas d'échec
            alert("Erreur: " + response.message);
        }
    });
});

function ajaxRequest(method, url, data, callback) {
    let xhr = new XMLHttpRequest();
    xhr.open(method, url);
    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                let jsonResponse = JSON.parse(xhr.responseText);
                callback(jsonResponse);
            } catch (e) {
                alert("Erreur lors du traitement de la réponse : " + e.message);
                console.error("Réponse reçue:", xhr.responseText);
            }
        } else {
            alert("Erreur de requête: " + xhr.status); // Afficher le code d'erreur HTTP
        }
    };
    xhr.onerror = function() {
        alert("Erreur de connexion au serveur."); // Afficher une erreur en cas d'échec de la requête
    };
    xhr.send(data);
}