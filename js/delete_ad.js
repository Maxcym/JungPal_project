//delete the ad from the database
document.getElementById('deleteAd').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default form submission

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
});
