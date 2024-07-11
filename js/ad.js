// get the informations from the form to create an ad 
document.getElementById('submitAd').addEventListener('click', function() {
    var formData = new FormData(document.getElementById('profileForm'));

    if (!formData.has('user_id')) {
        console.error('user_id is missing from form data');
    } else {
        console.log('user_id:', formData.get('user_id'));
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/JungPal_project/php/submit.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            alert(response.message);

            if (response.success) {
                document.getElementById('adId').value = response.ad_id;
            }
        } else {
            alert('An error occurred while submitting your ad.');
        }
    };
    xhr.send(formData);
});