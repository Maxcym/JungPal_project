document.getElementById('unlock').addEventListener('click', function() {
    var formData = new FormData(document.getElementById('profileForm'));
    console.log(...formData.entries()); // Print form data to the console for debugging

    if (!formData.has('ad_id')) {
        console.error('ad_id is missing from form data');
        alert('Ad ID is missing from form data.');
        return;
    }
    if (!formData.has('user_id')) {
        console.error('user_id is missing from form data');
        alert('User ID is missing from form data.');
        return;
    }

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
    xhr.send(formData);
});
