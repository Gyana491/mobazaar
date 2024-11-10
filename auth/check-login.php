<?php 
//start the session
session_start();
require($_SERVER['DOCUMENT_ROOT']  .'/mobazaar/require/global.php');
    if(isset($_SESSION['isloggedin']) == true){
        if(isset($_SESSION['user_id'])){
            $userid = $_SESSION['user_id'];
            $getuser = "SELECT * FROM mb_users WHERE user_id = $userid ";
            $userquery= mysqli_query($conn, $getuser);
            
            if(mysqli_num_rows($userquery) > 0){
                $userdata = mysqli_fetch_assoc($userquery);
    
                // Set each value of $userdata as a session variable
                if ($userdata) {
                    foreach ($userdata as $key => $value) {
                        
                        if($userdata[$key]){
                            $_SESSION[$key] = $userdata[$key];
                        }
                    }
                }
                
            }
    
        }
    //   print_r($_SESSION);  

    }
    else{
        header('location: /mobazaar/auth/login.php'); 
    }


?>