// Verify if a user is connected or not
function checkSession() {
    ajaxRequest("GET", "https://elderly-companions.azurewebsites.net/php/check_session.php", null, function(response) {
        if (!response.loggedIn) {
            // Redirect to the connecting page if the user isn't logged in
            window.location.href = "https://elderly-companions.azurewebsites.net/html/homepage.html";
        } else {
            // Print the connect user name
            console.log("Connected user : " + response.user_name);
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
                alert("Error in the response treatment : " + e.message);
                console.error("Response received:", xhr.responseText);
            }
        } else {
            alert("Error in the request: " + xhr.status); // Print HTTP error
        }
    };
    xhr.onerror = function() {
        alert("Error in the connexion to server."); // Print error if the request doesn't succeed
    };
    xhr.send(data);
}