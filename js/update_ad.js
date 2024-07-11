document.getElementById('unlock').addEventListener('click', function() {
    var formData = new FormData(document.getElementById('profileForm'));
    console.log(...formData.entries()); // Print form data to the console for debugging

    // Fetch user_id from server using get_user_id.php
    fetch('https://elderly-companions.azurewebsites.net/php/get_user_id.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Failed to fetch user ID (${response.status} ${response.statusText})`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            const userId = data.user_id; // Retrieve user_id from response

            console.log(`User ID: ${userId}`); // Log the retrieved user ID

            // Add user_id to formData
            formData.append('user_id', userId);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'https://elderly-companions.azurewebsites.net/php/update_ad.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    try {
                        var response = JSON.parse(xhr.responseText);
                        alert(response.message);

                        if (response.success) {
                            // Optionally handle any UI updates or actions on success
                        }
                    } catch (e) {
                        console.error('Invalid JSON response:', xhr.responseText);
                    }
                } else {
                    alert('An error occurred while submitting your ad.');
                }
            };
            xhr.onerror = function() {
                alert('An error occurred while connecting to the server.');
            };
            xhr.send(formData);

        } else {
            throw new Error('User ID not found in response data');
        }
    })
    .catch(error => {
        console.error('Error retrieving user ID:', error.message);
        alert('Failed to retrieve user ID. Please try again later.');
    });
});
