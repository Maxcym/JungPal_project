document.getElementById('deleteAd').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default form submission

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

            // Send delete request to delete_ad.php with user_id
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'https://elderly-companions.azurewebsites.net/php/delete_ad.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    try {
                        var response = JSON.parse(xhr.responseText);
                        alert(response.message);

                        if (response.success) {
                            // Refresh the page after successful deletion
                            window.location.reload();
                        }
                    } catch (e) {
                        console.error('Invalid JSON response:', xhr.responseText);
                        alert('An error occurred while processing the server response.');
                    }
                } else {
                    alert('An error occurred while submitting your ad.');
                }
            };

            var data = JSON.stringify({ user_id: userId });
            xhr.send(data);

        } else {
            throw new Error('Failed to retrieve user ID');
        }
    })
    .catch(error => {
        console.error('Error retrieving user ID:', error);
        alert('Error connecting to the server.');
    });
});
