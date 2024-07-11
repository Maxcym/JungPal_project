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
            throw new Error('Failed to retrieve user ID');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            const userId = data.user_id; // Retrieve user_id from response

            console.log(`User ID: ${userId}`); // Log the retrieved user ID

            // Check if ad_id is present in formData
            if (!formData.has('ad_id')) {
                console.error('ad_id is missing from form data');
                alert('Ad ID is missing from form data.');
                return;
            }

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
                            document.getElementById('adId').value = response.ad_id;
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
            throw new Error('Failed to retrieve user ID');
        }
    })
    .catch(error => {
        console.error('Error retrieving user ID:', error);
        alert('Error connecting to the server.');
    });
});
