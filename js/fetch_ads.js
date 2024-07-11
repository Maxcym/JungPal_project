// Show all ads
document.addEventListener("DOMContentLoaded", function() {
    fetch('https://elderly-companions.azurewebsites.net/php/fetch_ads.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const ads = data.ads;
                if (ads.length >= 3) {
                    // Shuffle the ads array
                    ads.sort(() => 0.5 - Math.random());

                    // Select the first three ads
                    const selectedAds = ads.slice(0, 3);

                    // Display the ads in the respective sections
                    displayAd('ad1', selectedAds[0]);
                    displayAd('ad2', selectedAds[1]);
                    displayAd('ad3', selectedAds[2]);
                } else {
                    console.error('Not enough ads available');
                }
            } else {
                console.error('Error:', data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});

function displayAd(elementId, ad) {
    const adElement = document.getElementById(elementId);
    const infoList = adElement.querySelector('ul');
    infoList.innerHTML = `
        <li><span>Rooms: ${ad.rooms}</span></li>
        <li><span>Price/month: €${ad.price}</span></li>
        <li><span>Area: ${ad.size} sqm</span></li>
        <li><span>Deposit: €${ad.deposit}</span></li>
        <li><span>Internet: ${ad.internet ? 'Yes' : 'No'}</span></li>
        <li><span>Campus: ${ad.campus_time} min</span></li>
    `;
}
