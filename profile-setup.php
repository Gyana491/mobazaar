<?php
require('require/global.php');

require($host.'/auth/check-login.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Set Up Your Profile</title>
    <?php require(  $host .'/require/tailwind.php'); ?>

</head>
<body class="bg-white dark:bg-gray-900">
 
<?php include($host.'/components/header.php') ;?>

<div class="max-w-2xl px-4  mx-auto " >
<?php 

if(isset($_FILES["upload"])){
  $target_dir = "user-profiles/";
  $target_file = $target_dir . basename($_FILES['upload']['name']);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    ;
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
      // echo '';
    } 
    else {
      
    }
  }
}
$userid= isset($_SESSION['user_id'])? $_SESSION['user_id'] : '';
if(isset($_POST['submit'])) {
  $name = isset($_POST['username']) ? $_POST['username'] : '';
  $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
  $country = isset($_POST['country']) ? $_POST['country'] : '';
  $state = isset($_POST['state']) ? $_POST['state'] : '';
  $city = isset($_POST['city']) ? $_POST['city'] : '';
  $pincode = isset($_POST['pincode']) ? $_POST['pincode'] : '';
  $imagename = isset($_FILES['upload']['name'][0]) ? $_FILES['upload']['name'] : $_POST['prev-image'];
  $user_image= isset($_POST['user_image']) ? $_POST['user_image'] : '';

  // Get the base64 encoded image data and the title from the POST request
    $user_image_data = isset($_POST['temp_image']) ? $_POST['temp_image'] : '';
    $title = isset($_POST['username']) ? $_POST['username'] : '';
    // Check if both the image data and title are provided
    if (!empty($user_image_data) && !empty($title)) {
            // Remove the data:image/webp;base64, prefix and decode the base64 image data
            $user_image_data = str_replace('data:image/webp;base64,', '', $user_image_data);
            $user_image_data = str_replace(' ', '+', $user_image_data);
            $decoded_image_data = base64_decode($user_image_data);
    
            // Set the target directory to save the image
            $target_dir = $host . "/user-profiles/";
    
            // Generate the filename
            $file_name = strtolower(str_replace(' ', '-', $title) . '-' . date("YmdHis")) . '.webp';
    
            // Check if the directory exists, if not, create it
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
    
            // Save the image file
            $file_path = $target_dir . $file_name;
            $image_saved = file_put_contents($file_path, $decoded_image_data);
    
            // Check if the image was saved successfully
            if ($image_saved !== false) {
                // echo "Image saved successfully.";
            } else {
                // echo "Failed to save the image.";
            }
        } else {
           $file_name= $user_image;
        }
  
  // Prepare an SQL statement
  $sql = "UPDATE mb_users SET username = ?, phone_number = ?, country = ?, state = ?, city = ?, pincode = ?, user_avatar = ? WHERE user_id = ?";
  
  // Prepare the statement
  $stmt = mysqli_prepare($conn, $sql);

  // Bind parameters
  mysqli_stmt_bind_param($stmt, "sssssssi", $name, $phone, $country, $state, $city, $pincode, $file_name, $userid);

  // Execute the statement
  if(mysqli_stmt_execute($stmt)) {
    unset($_POST);
    echo '
      <div class="flex items-center justify-between p-5 leading-normal text-green-600 bg-green-100 rounded-lg" role="alert">
        <p>Profile Saved Successfully!</p>
        <svg onclick="return this.parentNode.remove();" class="inline w-4 h-4 fill-current ml-2 hover:opacity-80 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
          <path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464zM359.5 133.7c-10.11-8.578-25.28-7.297-33.83 2.828L256 218.8L186.3 136.5C177.8 126.4 162.6 125.1 152.5 133.7C142.4 142.2 141.1 157.4 149.7 167.5L224.6 256l-74.88 88.5c-8.562 10.11-7.297 25.27 2.828 33.83C157 382.1 162.5 384 167.1 384c6.812 0 13.59-2.891 18.34-8.5L256 293.2l69.67 82.34C330.4 381.1 337.2 384 344 384c5.469 0 10.98-1.859 15.48-5.672c10.12-8.562 11.39-23.72 2.828-33.83L287.4 256l74.88-88.5C370.9 157.4 369.6 142.2 359.5 133.7z"/>
        </svg>
      </div>
    ';
  } else {
    echo "Error: " . mysqli_error($conn);
  }

  // Close the statement
  mysqli_stmt_close($stmt);
}

//get user data from database
$getuser = "SELECT * FROM mb_users WHERE user_id = $userid ";
$userquery= mysqli_query($conn, $getuser);
if(mysqli_num_rows($userquery) > 0){
  $userdata = mysqli_fetch_assoc($userquery);
//   print_r($userdata);
}

?>
</div>
<section class="bg-white dark:bg-gray-900">


  <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16 " >
     
    <form id="form" action="profile-setup.php" method="POST" enctype="multipart/form-data">
    
      <div class=" mx-auto bg-white rounded-lg shadow-md mb-4  items-center dark:bg-gray-700">
      <div  class="w-[250px]  p-4 rounded-lg items-center mx-auto text-center cursor-pointer dark:text-white" >
        
        <label for="upload" name="upload" class="cursor-pointer">
          
          <img id="image-preview" 
          src="<?php 
          if(isset($userdata['user_avatar'][0])){
            echo 'user-profiles/'.$userdata['user_avatar'];
          }else{
            echo "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png";
          }
          ?>" 
          class="  mb-4 rounded-full object-cover object-center w-full aspect-square mx-auto" alt="Image preview">

        <div id="loader" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col items-center justify-center  bg-white shadow-sm  dark:text-white dark:bg-gray-800 p-4 rounded              hidden  ">
                    <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-gray-100 m-auto" style="background: linear-gradient(to right, #ff00cc, #3333ff); "></div>
                        <p>Compressing Image...</p>
                    </div>
                    <div id="update-loader" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col items-center justify-center  bg-white shadow-sm  dark:text-white dark:bg-gray-800 p-4 rounded hidden ">
                <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-gray-100 m-auto" style="background: linear-gradient(to right, #ff00cc, #3333ff); "></div>
                <p>Setting Up Your Profile..</p>
            </div>


          <h5 class="w-full text-white bg-[#050708] hover:bg-[#050708]/90 focus:ring-4 focus:outline-none focus:ring-[#050708]/50 font-medium rounded-lg text-sm px-5 py-2.5 flex items-center justify-center mr-2 mb-2 cursor-pointer">Upload Profile Photo</h5>

          
          <span id="filename" class="text-gray-500 bg-gray-200 z-50"></span>
        </label>
              <input id="upload" type="file" class="hidden" name="upload" accept="image/*" >
              <input id="temp_image" type="text" class="hidden" name="temp_image" value=""  >
              <input id="user_image" type="text" class="hidden" name="user_image" 
              value="<?php 
          if(isset($userdata['user_avatar'])){
            echo $userdata['user_avatar'];
          }
          ?>"  >



      </div>
      <!-- <div class="flex items-center justify-center">
        <div class="w-full">
          <label class="w-full text-white bg-[#050708] hover:bg-[#050708]/90 focus:ring-4 focus:outline-none focus:ring-[#050708]/50 font-medium rounded-lg text-sm px-5 py-2.5 flex items-center justify-center mr-2 mb-2 cursor-pointer">
            <span class="text-center ml-2">Upload</span>
          </label>
        </div> -->
      </div>
    
     


          <div class="grid gap-4 mb-4 p-4 sm:grid-cols-2 sm:gap-6 sm:mb-5 bg-gray-100  rounded-lg  cursor-pointer dark:bg-gray-800">
              <div class="sm:col-span-2">
              <label for="website-admin" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Full Name</label>
                  <div class="flex">
                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                      <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                      </svg>
                    </span>
                    <input type="text" id="website-admin" name="username" class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ex. Gyana Ranjan" 
                    value='<?php echo isset($userdata['username']) ? $userdata['username'] : ''; ?>'>

                  </div>
              </div>
              
              <div class="sm:col-span-2">
                <label for="phone-number" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Phone Number</label>
                <div class="relative">
                  <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                  
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" id="phone"><path fill="currentColor" d="M12.2 10c-1.1-.1-1.7 1.4-2.5 1.8C8.4 12.5 6 10 6 10S3.5 7.6 4.1 6.3c.5-.8 2-1.4 1.9-2.5-.1-1-2.3-4.6-3.4-3.6C.2 2.4 0 3.3 0 5.1c-.1 3.1 3.9 7 3.9 7 .4.4 3.9 4 7 3.9 1.8 0 2.7-.2 4.9-2.6 1-1.1-2.5-3.3-3.6-3.4z"></path></svg> 
                  </div>
                  <input type="tel" id="phone-number" name="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="9876543210" value='<?php echo isset($userdata['phone_number']) ? $userdata['phone_number'] : ''; ?>'>
                </div>
              </div>
              
              
          </div>

          <div class="grid gap-4 mb-4 grid-cols-2 sm:gap-6 sm:mb-5 p-4 w-full bg-gray-100  rounded-lg  cursor-pointer dark:bg-gray-800">
              <div class="w-full">
                  <label for="country" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Country</label>
                  <input type="text" name="country" id="country" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="India" placeholder="India" required="">
              </div>
              <div class="w-full">
                  <label for="state" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">State</label>
                  <input type="text" name="state" id="state" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="odisha" required="" 
                  value='<?php echo isset($_SESSION['state']) ? $_SESSION['state'] : $_COOKIE['state']; ?>'>
              </div>
              <div class="w-full">
                  <label for="city" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">City</label>
                  <input type="text" name="city" id="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Cuttack" required=""
                  value='<?php echo isset($_SESSION['city'][0]) ? $_SESSION['city'] : $_COOKIE['city_district']; ?>'
                  >
              </div>
              <div class="w-full">
                  <label for="Pincode" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Pincode</label>
                  <input type="number" name="pincode" id="pincode" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="753001" required=""
                  value='<?php echo isset($_SESSION['pincode'][0]) ? $_SESSION['pincode'] : $_COOKIE['postcode']; ?>'
                  >
              </div>
            </div>   
              
          <div class="flex justify-center items-center space-x-4">
          <button type="submit" name="submit" id="submitbtn" class=" w-3/4 text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-primary-800">
                 Update Profile
              </button>

          <a href="./auth/logout.php">
          <button type="button"  class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Log Out</button>
          </a>
              <!-- <input type="submit" value="Upload Image" name="submit"> -->
              <!-- <button type="button" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                  Log Out
              </button> -->
          </div>
      </form>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/compressorjs"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const uploadInput = document.getElementById('upload');
        const imagePreview = document.getElementById('image-preview');
        const coverImage = document.getElementById('temp_image');
        const submitbtn = document.getElementById('submitbtn');
        const updateloader = document.getElementById('update-loader');
        const loader = document.getElementById('loader');
        const form = document.getElementById('form');


        // Check if elements exist
        if (!uploadInput || !imagePreview || !coverImage || !submitbtn || !updateloader || !loader) {
            console.error('One or more elements are missing from the DOM.');
            return;
        }

        // Display loader on submit button click
        submitbtn.addEventListener('click', () => {
            if(form.checkValdity() == ){
                updateloader.style.display = 'block';
            }   
        });
     

        // Handle image upload
        uploadInput.addEventListener('change', handleImageUpload);

        function handleImageUpload(event) {
            const file = event.target.files[0];
            if (!file) {
                console.error('No file selected.');
                return;
            }

            // Show loader
            loader.style.display = 'block';

            // Compress the image
            new Compressor(file, {
                quality: 0.25, // Adjust the quality as needed
                success(result) {
                    // Convert to base64
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = new Image();
                        img.onload = function () {
                            const canvas = document.createElement('canvas');
                            canvas.width = img.width;
                            canvas.height = img.height;
                            const ctx = canvas.getContext('2d');
                            ctx.drawImage(img, 0, 0);
                            const base64 = canvas.toDataURL('image/webp');
                            console.log(base64);
                            imagePreview.src = base64; // Display the preview
                            coverImage.value = base64;
                            // Hide loader after image preview is updated
                            loader.style.display = 'none';
                        };
                        img.src = e.target.result;
                    };
                    reader.readAsDataURL(result);
                },
                error(err) {
                    console.error(err.message);
                    // Hide loader on error
                    loader.style.display = 'none';
                },
            });
        }
    });
</script>
  
  <?php include($host.'/components/footer.php') ;?>
</body>
</html>
