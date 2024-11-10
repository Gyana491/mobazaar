<?php
require('require/global.php');



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="15"> -->
    <title>Mo Bazaar | Free classifieds in India, Buy and Sell for free anywhere in India with MoBazaar Online Classified Advertising</title>
   <?php require($host.'/require/tailwind.php'); ?>
</head>
<body class=" dark:bg-gray-900 dark:text-white ">
<?php include($host.'/components/header.php') ?>



<section class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 justify-center bg-white dark:bg-gray-900 p-4 max-w-screen-xl  mx-auto">


 <?php 
$category_id = isset($_GET['name']) ? $_GET['name'] : '';
// Fetch listings from the database
$sql = "SELECT * FROM `mb_listings` WHERE `category_id`='$category_id' ORDER BY listing_id DESC ";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    while ($row= mysqli_fetch_assoc($result)) {
        // Display the template for each listing
        echo '<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="single.php?id=' . $row['listing_id'] . '">
                    <div class="w-full aspect-w-16 aspect-h-9">
                        <img src="uploads/' . $row['cover_image'] . '" class="object-cover w-full h-full aspect-square" alt="Your Image">
                    </div>
                </a>
                <div class="p-5">
                    <a href="single.php?id=' . $row['listing_id'] . '">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">₹ ' . $row['price'] . '</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 line-clamp-1 lg:line-clamp-2">' . $row['name'] . '</p>
                    <div class="flex items-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1.5 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4c3.865 0 7 3.134 7 7 0 3.337-3 8-7 13-4-5-7-9.663-7-13 0-3.866 3.135-7 7-7zM12 6a2 2 0 100 4 2 2 0 000-4z" />
                        </svg>
                        <p class="font-normal text-gray-700 dark:text-gray-400 line-clamp-1 lg:line-clamp-2">' . $row['city'] . ', ' . $row['state'] . '</p>
                    </div>
                    <a href="single.php?id=' . $row['listing_id'] . '" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800  ">
                        <span class="line-clamp-1 ">Check Details</span>
                        
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
            </div>';
    }
} else {
    echo "No listings found";
}
?>

 

</section>

<?php
// Read city and region from cookies

// Retrieve the values of cookies if they exist
$city = isset($_COOKIE['city']) ? $_COOKIE['city'] : '';
$state = isset($_COOKIE['state']) ? $_COOKIE['state'] : '';
$postcode = isset($_COOKIE['postcode']) ? $_COOKIE['postcode'] : '';
if($city){
    echo '
    <div class="max-w-sm mx-auto my-auto flex justify-start ">
    <p class=" mx-auto my-auto dark:text-white">Current Location:'. $city.', '.$state.', '. $postcode.' </p>
    </div>
    ';
}
?>



<script>
if ('serviceWorker' in navigator) {
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("service-worker.js").then(function(reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        }).catch(function(error) {
            console.error("Service worker registration failed:", error);
        });
    } else {
        console.log("Service worker is already controlling the page.");
    }
} else {
    console.error("Service workers are not supported in this browser.");
}
</script>

</body>
</body>
</html>
