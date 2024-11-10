<?php
session_start();

require($_SERVER['DOCUMENT_ROOT']  .'/mobazaar/require/global.php');
require($host.'/auth/check-login.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="15"> -->
    <title>Mo Bazaar | Categories</title>
   <?php require($host.'/require/tailwind.php'); ?>
</head>
<body class=" dark:bg-gray-900 dark:text-white ">
<?php include($host.'/components/header.php') ?>


 <?php 
    $user_role= isset($_SESSION['user_role'])?$_SESSION['user_role'] : '';
    if($user_role == "admin"){
        echo '
        <div class="justify-right  bg-white dark:bg-gray-900 p-4 max-w-screen-xl  mx-auto">
            <a href="create-category.php" >
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create New Category</button>
            </a>
            </div>
        ';   
    }
    else{

    }
    
    ?>
<section class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 justify-center bg-white dark:bg-gray-900 p-4 max-w-screen-xl  mx-auto">
   




 <?php 
// Fetch listings from the database
$sql = "SELECT * FROM `mb_categories` ORDER BY category_id DESC";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    while ($row= mysqli_fetch_assoc($result)) {
        // Display the template for each listing
        echo '<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
               
                
                <div class="p-5">
                    
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 line-clamp-1 lg:line-clamp-2">' . $row['category_name'] . '</p>

                    <a href="/mobazaar/category.php?name=' . $row['category_name'] . '" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800  ">
                        
                        
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
            </div>';
    }
} else {
    echo "No Categories found";
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
    echo '<p class="mb-[80px] text-center mx-auto dark:text-white">City:'. $city.', State:'.$state.', Postcode:'. $postcode.' </p>';
}
?>




</body>
</body>
</html>
