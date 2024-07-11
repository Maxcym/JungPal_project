document.getElementById('submitAd').addEventListener('click', function() {
    // Create a new FormData object from the profileForm
    var formData = new FormData(document.getElementById('profileForm'));

    // Retrieve the user_id from the session or wherever it's stored
    fetch('https://elderly-companions.azurewebsites.net/php/get_user_id.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Add user_id to formData
            formData.append('user_id', data.user_id);

            // Submit the form data to the PHP script to create an ad
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'https://elderly-companions.azurewebsites.net/php/submit.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    alert(response.message);

                    if (response.success) {
                        document.getElementById('adId').value = response.ad_id;
                        alert('Ad created with success.');
                    }
                } else {
                    alert('An error occurred while submitting your ad.');
                }
            };
            xhr.send(formData); // Send formData with user_id included
        } else {
            console.error('Failed to retrieve user_id:', data.message);
            alert('Erreur: ' + data.message);
        }
    })
    .catch(error => console.error('Fetch Error:', error));
});
