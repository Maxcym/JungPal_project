// get the informations of an add from the database to print on the ad's page
document.addEventListener("DOMContentLoaded", function() {
    fetch('http://localhost/JungPal_project/php/fetch_all_ads.php')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json(); // Parse JSON response
        })
        .then(data => {
            if (data.success) {
                const announcementsContainer = document.getElementById('announcements-container');
                if (announcementsContainer) {
                    data.ads.forEach(ad => {
                        const adElement = document.createElement('div');
                        adElement.className = 'announcement';

                        adElement.innerHTML = `
                            <div id="container">
                                <div class="ligne-verticale"></div>
                                <div id="info_house">
                                    <ul>
                                        <li><span>Rooms: ${ad.rooms}</span></li>
                                        <li><span>Price/month: €${ad.price}</span></li>
                                        <li><span>Area: ${ad.size} sqm</span></li>
                                        <li><span>Deposit: €${ad.deposit}</span></li>
                                        <li><span>Internet connection: ${ad.internet ? 'Yes' : 'No'}</span></li>
                                        <li><span>${ad.campus_time} minutes to Campus</span></li>
                                    </ul>
                                </div>
                                <div class="ligne-verticale_2"></div>
                                <div id="Party">Party: ${ad.party}</div>
                                <div id="Garden">Garden help: ${ad.garden}</div>
                                <div id="Cleaning">Cleaning: ${ad.cleaning}</div>
                                <div class="ligne-verticale_3"></div>
                                <button class="button" data-ad-id="${ad.id}">See the announce</button>
                            </div>
                        `;

                        announcementsContainer.appendChild(adElement);

                        // Add click event listener to the "See the announce" button
                        const seeAnnounceButton = adElement.querySelector('.button');
                        if (seeAnnounceButton) {
                            seeAnnounceButton.addEventListener('click', function() {
                                const adId = this.getAttribute('data-ad-id');
                                window.location.href = `add.html?id=${ad.id}`; // Corrected adId variable
                            });
                        }
                    });
                } else {
                    console.error('Announcements container not found.');
                }
            } else {
                console.error('Error:', data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});
