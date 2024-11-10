<?php

$host = "sql109.infinityfree.com"; // Change this to your database host
$username = "if0_36480631"; // Change this to your database username
$password = "16tayzFAgW8VE"; // Change this to your database password
$database = "if0_36480631_mobazaar"; // Change this to your database name

// Attempt to connect to MySQL database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // echo "Connected successfully";
}

// $sql = 'INSERT INTO `mb_listings` (`listing_id`, `name`, `seller_id`, `category_id`, `price`, `description`, `images`, `cover_image`, `country`, `state`, `city`, `pincode`, `address`) VALUES (NULL, "Infinix Laptop 4", 4, 2, 10000, "New Conditon", NULL, "laptop.jpg", "India", "Odisha", "Cuttack", "753001", "Ranihat Colony, Cuttack, Odisha");';  

// if(mysqli_query($conn, $sql)){  

//  echo "Record inserted successfully";  

// }else{  

// echo "Could not insert record: ". mysqli_error($conn);  

// } 
?>
