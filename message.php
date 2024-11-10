<?php
// Include required files
require('require/global.php');
require($host.'/auth/check-login.php');

// Check if seller-id is set in the URL
if($_SESSION['isloggedin'] == 1) {
    // Print the GET parameters for debugging
    // print_r($_GET);

    // Get seller-id from the URL
    $seller_id = isset($_GET['seller-id']) ? $_GET['seller-id'] : '';
    $offerprice = isset($_GET['offer-price']) ? $_GET['offer-price'] : '';
    

    // Initialize variables
    $seller_name = "";
    $listing_id = isset($_GET['listing-id']) ? $_GET['listing-id'] : '';
    $seller_phone = "";
    $listing_name = "";
    $user_id = isset($_GET['user-id']) ? $_GET['user-id'] : '';


    // Query to get user details based on seller-id
    $usersql = "SELECT * FROM `mb_users` WHERE user_id = {$seller_id}";
    $userresult = mysqli_query($conn, $usersql); 

    // Check if user exists
    if (mysqli_num_rows($userresult) > 0) {
        while ($user = mysqli_fetch_assoc($userresult)) {
            // Get seller name
            $seller_name = $user['username'];
            // echo $seller_name; // Debugging purpose
        }
    }
    // echo $seller_name; // Debugging purpose

    // Query to get listing details based on listing-id
    $listingsql = "SELECT * FROM `mb_listings` WHERE listing_id = {$listing_id}";
    $listingresult = mysqli_query($conn, $listingsql); 

    // Check if listing exists
    if (mysqli_num_rows($listingresult) > 0) {
        while ($listing = mysqli_fetch_assoc($listingresult)) {
            // Get listing name
            $listing_name = $listing['name'];
            $seller_phone = $listing['seller_no'];
            // echo $listing_name;
            // echo $seller_phone;// Debugging purpose
        }
    }
    

    
    // Prepare an SQL statement
    $insertsql = "INSERT INTO `mb_chat_history` (`user_id`, `seller_id`, `listing_id`) VALUES (?, ?, ?)";
    
    // Prepare the statement
    $insertchat = mysqli_prepare($conn, $insertsql);
    mysqli_stmt_bind_param($insertchat, "iii", $user_id, $seller_id, $listing_id);
    // Execute the prepared statement
    mysqli_stmt_execute($insertchat);
    
    $message= urlencode("Hi! $seller_name,\nI am Interested in Buying $listing_name.\n\n @Price: ₹ $offerprice \n\nLet's Make a Deal If You are Interested !  \n\nLink: $hostname/single.php?id=$listing_id");
    
    // Redirect to WhatsApp URL (uncomment and fill in details as needed)
    $url = "https://api.whatsapp.com/send/?phone="."91".$seller_phone . "&text=" . $message;
    header("Location: $url");
}
?>
