// Send the price select in the form to print only the ads under it
document.addEventListener("DOMContentLoaded", function() {
    const searchButton = document.getElementById('button_search');
    const costInput = document.getElementById('cost');

    searchButton.addEventListener('click', function() {
        const maxPrice = costInput.value;
        fetchAds(maxPrice);
    });

    function fetchAds(maxPrice) {
        fetch(`https://elderly-companions.azurewebsites.net/php/fetch_ads_price.php?maxPrice=${maxPrice}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json(); // Parse JSON response
            })
            .then(data => {
                if (data.success) {
                    const announcementsContainer = document.getElementById('announcements-container');
                    announcementsContainer.innerHTML = ''; // Clear existing ads

                    if (announcementsContainer) {
                        data.ads.forEach(ad => {
                            if (ad.price <= maxPrice) {
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

                                const seeAnnounceButton = adElement.querySelector('.button');
                                if (seeAnnounceButton) {
                                    seeAnnounceButton.addEventListener('click', function() {
                                        const adId = this.getAttribute('data-ad-id');
                                        window.location.href = `announce.html`;
                                    });
                                }
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
    }
});
