<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check if geolocation is supported by the browser
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;

                // Make the API request inside the geolocation callback
                fetch("https://nominatim.openstreetmap.org/search?q=" + latitude + "," + longitude + "&format=json&polygon=1&addressdetails=1")
                .then(response => response.json())
                .then(function(response) {
                    if (response.length > 0) {
                        var fullAddress = response[0].address;

                        // Store each address information in a browser cookie
                        Object.entries(fullAddress).forEach(([key, value]) => {
                            // Update or create cookie for each address detail
                            document.cookie = `${key}=${value}; path=/`;
                            // console.log("Cookie set:", `${key}=${value}; path=/`);
                        });

                        // Log all cookies
                        // console.log("All Cookies:", document.cookie);
                    } else {
                        console.log("No address data found.");
                    }
                })
                .catch(error => console.error('Error fetching address information:', error));
            });
        } else {
            console.log("Geolocation is not supported by this browser.");
        }
    });
</script>


