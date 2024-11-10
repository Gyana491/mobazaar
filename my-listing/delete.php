<?php
require($_SERVER['DOCUMENT_ROOT'] . '/mobazaar/require/global.php');
require($host . '/auth/check-login.php');

// Check if the ID parameter is provided in the URL
if(isset($_GET['id'])) {
    // Sanitize the ID parameter to prevent SQL injection
    $id = intval($_GET['id']);
    
    // Prepare the SQL query to delete the record
    $sql = "DELETE FROM `mb_listings` WHERE `listing_id` = ?";
    
    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);
    
    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    // Execute the statement
    mysqli_stmt_execute($stmt);
    
    // Check if any rows were affected
    if(mysqli_stmt_affected_rows($stmt) > 0) {
        // Record deleted successfully
        // Redirect to my-listing page
        header("Location: /mobazaar/my-listing?delete=success");
        exit(); // Make sure to exit after redirection
    } else {
        // No matching record found
        echo "No record found with ID $id.";
    }
    
    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // ID parameter not provided in the URL
    echo "No ID parameter provided.";
}
?>
