// Verify if a user is connected or not
function checkSession() {
    ajaxRequest("GET", "http://localhost/JungPal_project/php/check_session.php", null, function(response) {
        if (!response.loggedIn) {
            // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
            window.location.href = "http://localhost/JungPal_project/html/homepage.html";
        } else {
            // Afficher le nom de l'utilisateur connecté
            console.log("Utilisateur connecté : " + response.user_name);
        }
    });
}

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
