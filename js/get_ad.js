document.addEventListener("DOMContentLoaded", function() {
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

            // Fetch ad information based on user_id
            fetch(`https://elderly-companions.azurewebsites.net/php/get_ad.php?user_id=${userId}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Server Response:', data); // Log server response
                    if (data.success) {
                        document.getElementById('title').textContent = `Rent a room at ${data.name}'s`;
                        document.getElementById('name').textContent = data.name;
                        document.getElementById('surname').textContent = data.surname;
                        document.getElementById('age').textContent = calculateAge(data.dob) + " years old";
                        document.querySelector("#info_house li:nth-child(1) span").textContent = `Number of rooms: ${data.rooms}`;
                        document.querySelector("#info_house li:nth-child(2) span").textContent = `Price per month: €${data.price}`;
                        document.querySelector("#info_house li:nth-child(3) span").textContent = `Area: ${data.size} sqm`;
                        document.querySelector("#info_house li:nth-child(4) span").textContent = `Deposit required: €${data.deposit}`;
                        document.querySelector("#info_house li:nth-child(5) span").textContent = `Internet connection: ${data.internet}`;
                        document.querySelector("#info_house li:nth-child(6) span").textContent = `${data.campus_time} minutes from the Campus`;

                        document.getElementById('Party').textContent = `Party: ${data.party}`;
                        document.getElementById('Garden').textContent = `Garden help: ${data.garden}`;
                        document.getElementById('Cleaning').textContent = `Cleaning: ${data.cleaning}`;
                    } else {
                        alert("Error: " + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error fetching ad information:', error);
                    alert('Error connecting to the server.');
                });
        } else {
            throw new Error('Failed to retrieve user ID');
        }
    })
    .catch(error => {
        console.error('Error retrieving user ID:', error);
        alert('Error connecting to the server.');
    });
});

function calculateAge(birthDate) {
    const birth = new Date(birthDate);
    const today = new Date();
    let age = today.getFullYear() - birth.getFullYear();
    const monthDiff = today.getMonth() - birth.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
        age--;
    }
    return age;
}
