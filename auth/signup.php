<?php
// Start the session
session_start();

// Include global.php and any other necessary files
require($_SERVER['DOCUMENT_ROOT'] . '/mobazaar/require/global.php');

// Handle form submission and redirection
if(isset($_POST['submit'])) {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirmpassword = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    if($conn){
        // Check if email already exists
        $check_sql = "SELECT * FROM `mb_users` WHERE `email` = ?";
        $check_stmt = mysqli_prepare($conn, $check_sql);
        mysqli_stmt_bind_param($check_stmt, "s", $email);
        mysqli_stmt_execute($check_stmt);
        $result = mysqli_stmt_get_result($check_stmt);
        
        if(mysqli_num_rows($result) > 0){
            echo '
            <div class="flex items-center justify-between p-5 leading-normal text-red-600 bg-red-100 rounded-lg" role="alert">
                <p>Account Already Exists</p>
                <svg onclick="return this.parentNode.remove();" class="inline w-4 h-4 fill-current ml-2 hover:opacity-80 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464zM359.5 133.7c-10.11-8.578-25.28-7.297-33.83 2.828L256 218.8L186.3 136.5C177.8 126.4 162.6 125.1 152.5 133.7C142.4 142.2 141.1 157.4 149.7 167.5L224.6 256l-74.88 88.5c-8.562 10.11-7.297 25.27 2.828 33.83C157 382.1 162.5 384 167.1 384c6.812 0 13.59-2.891 18.34-8.5L256 293.2l69.67 82.34C330.4 381.1 337.2 384 344 384c5.469 0 10.98-1.859 15.48-5.672c10.12-8.562 11.39-23.72 2.828-33.83L287.4 256l74.88-88.5C370.9 157.4 369.6 142.2 359.5 133.7z"/>
                </svg>
            </div>';
        } else {
            $sql = "INSERT INTO `mb_users` (`username`, `email`, `user_password`) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $confirmpassword);

            if(mysqli_stmt_execute($stmt)){  
                $user_id = mysqli_insert_id($conn);
                $_SESSION['email'] = $email;
                $_SESSION['isloggedin'] = true;
                $_SESSION['user_id'] = $user_id;
                header('location: /mobazaar/profile-setup.php');
            } else {  
                echo "Could not insert record: ". mysqli_error($conn);  
            } 
            mysqli_stmt_close($stmt);
        }
        mysqli_stmt_close($check_stmt);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <?php require($host . '/require/tailwind.php'); ?>
</head>
<body class="bg-white dark:bg-gray-900">
    
<section class="bg-white dark:bg-gray-900">

     <!-- source:https://codepen.io/owaiswiz/pen/jOPvEPB -->
<div class="min-h-screen bg-gray-100 text-gray-900 flex justify-center dark:bg-gray-900  ">
    <div class="max-w-screen-xl m-0 sm:m-10 bg-white shadow sm:rounded-lg flex justify-center flex-1 dark:bg-gray-800">
        <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
            <a href="/mobazaar/index.php">
                <img src="../assets/Mo-Bazaar-Logo.jpg"
                    class="w-32 mx-auto" />
            </a>
            <div class="mt-12 flex flex-col items-center">
                <h1 class="text-2xl xl:text-3xl font-extrabold dark:text-white">
                    Sign up To Mo Bazaar
                </h1>
                
                <div class="w-full flex-1 mt-8">

                    <form action="./signup.php" method="post">
                    <div class="mx-auto max-w-xs">
                        <input
                            class="text-md block px-3 py-2 rounded-lg w-full 
                            bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md
                            focus:placeholder-gray-500
                            focus:bg-white 
                            focus:border-gray-600  
                            focus:outline-none"
                            id="email" name="email" 
                            type="email" placeholder="Email" required/>

                    <div class="py-2" x-data="{ show: true }">
                        
                        <div class="relative">
                            <input id="password"  placeholder="Enter Password" :type="show ? 'password' : 'text'" class="text-md block px-3 py-2 rounded-lg w-full 
                        bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md
                        focus:placeholder-gray-500
                        focus:bg-white 
                        focus:border-gray-600  
                        focus:outline-none">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
        
                            <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                                :class="{'hidden': !show, 'block':show }" xmlns="http://www.w3.org/2000/svg"
                                viewbox="0 0 576 512">
                                <path fill="currentColor"
                                d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                </path>
                            </svg>
        
                            <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                                :class="{'block': !show, 'hidden':show }" xmlns="http://www.w3.org/2000/svg"
                                viewbox="0 0 640 512">
                                <path fill="currentColor"
                                d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                </path>
                            </svg>
        
                            </div>
                        </div>
                        </div>
                        <div class="py-2" x-data="{ show: true }">
                            
                            <div class="relative">
                              <input id="confirm_password" name="confirm_password" placeholder="Confirm Password" :type="show ? 'password' : 'text'" class="text-md block px-3 py-2 rounded-lg w-full 
                            bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md
                            focus:placeholder-gray-500
                            focus:bg-white 
                            focus:border-gray-600  
                            focus:outline-none">
                              <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
            
                                <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                                  :class="{'hidden': !show, 'block':show }" xmlns="http://www.w3.org/2000/svg"
                                  viewbox="0 0 576 512">
                                  <path fill="currentColor"
                                    d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                  </path>
                                </svg>
            
                                <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                                  :class="{'block': !show, 'hidden':show }" xmlns="http://www.w3.org/2000/svg"
                                  viewbox="0 0 640 512">
                                  <path fill="currentColor"
                                    d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                  </path>
                                </svg>
            
                              </div>
                            </div>
                          </div>
                          <p id="validation" class="text-center text-orange-500 italic text-sm"></p>
                        <button
                        id="submit" name="submit" type="submit"
                            class=" mt-5 tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-4 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                            <svg class="w-6 h-6 -ml-2" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                <circle cx="8.5" cy="7" r="4" />
                                <path d="M20 8v6M23 11h-6" />
                            </svg>
                            <span class="ml-3 ">
                                Sign Up
                            </span>
                        </button>
                        
                    </div>
                </form>
                </div>
            </div>
            <div class="flex w-full items-center gap-2 py-6 text-sm text-slate-600">
                <div class="h-px w-full bg-slate-200 "></div>
                <p class="dark:text-white">OR</p>
                <div class="h-px w-full bg-slate-200"></div>
            </div>
            <p class="mt-2 text-center dark:text-white">Already Have an Account ! </p>
            <a href="./login.php">
                    
                <button  class=" mt-5 tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-4 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                    <span class="ml-3 ">
                        Log In Here
                    </span>
                </button>
            </a>
         
        </div>
        
    </div>
</div>
  

</section>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script type="text/javascript">
  $("#confirm_password").on("keyup", function () {
    var password = $("#password").val();
    var confirmPassword = $(this).val();
    
    if (confirmPassword !== "" && password !== confirmPassword) {
      $("#validation").html("Password does not match!").show();
      $("#submit").hide();
    } else {
      $("#validation").hide();
      $("#submit").show();
    }
  });

  $("#showPw").click(function () {
    var passInput = $("#password, #confirm_password");
    if (passInput.attr("type") === "password") {
      passInput.attr("type", "text");
      $("#showHide").html("Hide");
    } else {
      passInput.attr("type", "password");
      $("#showHide").html("Show");
    }
  });
</script> 
</body>
</html>
