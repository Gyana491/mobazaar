<?php 
require($_SERVER['DOCUMENT_ROOT']  .'/mobazaar/require/global.php');
require($host.'/auth/check-login.php');

?>
<?php

  if(isset($_POST['submit'])  ) {
    $user_id = isset($_SESSION['user_id'])? $_SESSION['user_id'] : '';
    // Get the base64 encoded image data and the title from the POST request
    $cover_image_data = isset($_POST['cover_image']) ? $_POST['cover_image'] : '';
   
    $category_title = isset($_POST['category_title']) ? $_POST['category_title'] : '';
    $category_slug =  str_replace(' ', '-',$category_title);
    $title= $category_title;

    // Check if both the image data and title are provided
    if (!empty($cover_image_data) && !empty($title)) {
            // Remove the data:image/webp;base64, prefix and decode the base64 image data
            $cover_image_data = str_replace('data:image/webp;base64,', '', $cover_image_data);
            $cover_image_data = str_replace(' ', '+', $cover_image_data);
            $decoded_image_data = base64_decode($cover_image_data);
    
            // Set the target directory to save the image
            $target_dir = $host . "/uploads/categories/";
    
            // Generate the filename
            $file_name = str_replace(' ', '-', $title) . '-' . date("YmdHis") . '.webp';
    
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
            // echo "Image data or title is missing.";
        }
     
    
    // Prepare an SQL statement
    $sql = "INSERT INTO `mb_categories` (`category_name`,`category_slug`,`category_image`) VALUES ('$category_title','$category_slug', '$file_name')";

    $result= mysqli_query($conn, $sql);

  
    // Execute the statement
    if($result) {
      header("Location: /mobazaar/categories");
    }
  }
  
  ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a New Category</title>
    <?php require(  $host .'/require/tailwind.php'); ?>

</head>
<body class="bg-white dark:bg-gray-900">
  <?php include($host.'/components/header.php') ;?>



  <section class="bg-white dark:bg-gray-900">
  <div class=" max-w-3xl  mx-auto px-4 py-4 mx-auto ">
      <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white text-center">Create a New Category !</h2>
      <form action="./create-category.php" method="post" enctype="multipart/form-data">

      <div class=" mx-auto bg-white rounded-lg shadow-md mb-4  items-center dark:bg-gray-800 ">
        <div  class="p-6 mb-4   rounded-lg items-center mx-auto text-center cursor-pointer  max-w-xl" >
            <style>
                #loader {
                /* Position the overlay at the center */
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
            </style>
        
        <label for="upload" name="upload" class="cursor-pointer relative">
            <div id="loader" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col items-center justify-center  bg-white shadow-sm  dark:text-white dark:bg-gray-800 p-4 rounded hidden ">
                <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-gray-100 m-auto" style="background: linear-gradient(to right, #ff00cc, #3333ff); "></div>
                <p>Compressing Image...</p>
            </div>
            
            <img id="image-preview" src="../assets/place-holder.jpg" class="mb-4 rounded-lg w-full object-center object-cover aspect-[4/3] mx-auto" alt="Image preview">
            
            <h5 class="w-full text-white bg-[#050708] hover:bg-[#050708]/90 focus:ring-4 focus:outline-none focus:ring-[#050708]/50 font-medium rounded-lg text-sm px-5 py-2.5 flex items-center justify-center mr-2 mb-2 cursor-pointer">Upload Cover Image</h5>
            
            <span id="filename" class="text-gray-500 bg-gray-200 z-50"></span>
        </label>
          <input id="upload" type="file" class="hidden" name="upload" accept="image/*" >
          <input id="cover_image" type="text" class="hidden" name="cover_image"  value=""  >
          
        </div>
      </div>
   

   
      <div  class="p-4 mb-4 w-full bg-gray-100  rounded-lg  cursor-pointer dark:bg-gray-800" >
          <div class="w-full">
              <label for="category_title" class="block my-2 text-sm  font-bold text-gray-900 dark:text-white">Category Name</label>
              <input type="text" name="category_title" id="category_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="" placeholder="Enter Category Name" required="">
          </div>
        </div>

              
          <div class="flex items-center justify-center space-x-4">
              <button type="submit" name="submit" class=" w-3/4 text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-primary-800">
                  Create New Category
              </button>
              
          </div>
      </form>
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/compressorjs"></script>
    <script>
        const uploadInput = document.getElementById('upload');
        const imagePreview = document.getElementById('image-preview');
        const coverImage = document.getElementById('cover_image');
        
        const loader = document.getElementById('loader');

        uploadInput.addEventListener('change', handleImageUpload);

        function handleImageUpload(event) {
            const file = event.target.files[0];

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
                            imagePreview.src = base64;// Display the preview
                            coverImage.value = base64;
                            // Hide loader
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
    </script>
</body>
</html>
