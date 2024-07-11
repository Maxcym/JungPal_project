// Get the informations from the form to update the ad
document.getElementById('unlock').addEventListener('click', function() {
    var formData = new FormData(document.getElementById('profileForm'));
    console.log(...formData.entries()); // Print form data to the console for debugging

    if (!formData.has('user_id')) {
        console.error('user_id is missing from form data');
    } else {
        console.log('user_id:', formData.get('user_id'));
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/JungPal_project/php/update_ad.php', true);
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
    xhr.send(formData);
});
