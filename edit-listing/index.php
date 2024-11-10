<?php
require($_SERVER['DOCUMENT_ROOT'] . '/mobazaar/require/global.php');
require($host . '/auth/check-login.php');

// Get the listing ID from the URL parameter
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Query the database to retrieve the listing details
$sql = "SELECT * FROM mb_listings WHERE listing_id = $id";
$result = mysqli_query($conn, $sql);
$listing = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $pincode = isset($_POST['pincode']) ? $_POST['pincode'] : '';
    $state = isset($_POST['state']) ? $_POST['state'] : '';
    $country = isset($_POST['country']) ? $_POST['country'] : '';
    $phone_number = isset($_POST['phone']) ? $_POST['phone'] : '';
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
    $prev_cover_image = isset($_POST['prev_cover_image']) ? $_POST['prev_cover_image'] : '';

    $address = $city . ',' . $state;
    // Get the base64 encoded image data and the title from the POST request
    $cover_image_data = isset($_POST['cover_image']) ? $_POST['cover_image'] : '';

    $title = isset($_POST['title']) ? $_POST['title'] : '';
    // Check if both the image data and title are provided
    if (!empty($cover_image_data) && !empty($title)) {
            // Remove the data:image/webp;base64, prefix and decode the base64 image data
            $cover_image_data = str_replace('data:image/webp;base64,', '', $cover_image_data);
            $cover_image_data = str_replace(' ', '+', $cover_image_data);
            $decoded_image_data = base64_decode($cover_image_data);
    
            // Set the target directory to save the image
            $target_dir = $host . "/uploads/";
    
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
                
            }
        } else {
           $file_name= $prev_cover_image;
        }

    // Prepare the SQL statement for updating the listing
    $sql = "UPDATE mb_listings SET 
                name = '$title', 
                price = '$price', 
                category_id = '$category', 
                description = '$description', 
                city = '$city', 
                pincode = '$pincode', 
                seller_no = '$phone_number', 
                country = '$country', 
                state = '$state', 
                cover_image = '$file_name'
            WHERE listing_id = $id";

    $result = mysqli_query($conn, $sql);

    // Redirect to the appropriate page after successful update
    if ($result) {
        header("Location: /mobazaar/my-listing?update=success");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Listing</title>
    <?php require($host . '/require/tailwind.php'); ?>
</head>
<body>
    <?php include($host . '/components/header.php'); ?>

    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-3xl mx-auto px-4 py-4">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white text-center">Edit Listing</h2>
            <form id="form" action="" method="post" enctype="multipart/form-data">

                <div class="mx-auto bg-white rounded-lg shadow-md mb-4 items-center dark:bg-gray-800">
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
                    <div id="update-loader" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col items-center justify-center  bg-white shadow-sm  dark:text-white dark:bg-gray-800 p-4 rounded hidden ">
                <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-gray-100 m-auto" style="background: linear-gradient(to right, #ff00cc, #3333ff); "></div>
                <p>Updating Listing..</p>
                </div>
            
                    
                    <img id="image-preview" src="<?php echo $listing['cover_image'] ? '/mobazaar/uploads/' . $listing['cover_image'] : '../assets/place-holder.jpg'; ?>" class="mb-4 rounded-lg w-full object-center object-cover aspect-[4/3] mx-auto" alt="Image preview">
                    
                    <h5 class="w-full text-white bg-[#050708] hover:bg-[#050708]/90 focus:ring-4 focus:outline-none focus:ring-[#050708]/50 font-medium rounded-lg text-sm px-5 py-2.5 flex items-center justify-center mr-2 mb-2 cursor-pointer">Upload Cover Image</h5>
                    
                    <span id="filename" class="text-gray-500 bg-gray-200 z-50"></span>
                </label>
              <input id="upload" type="file" class="hidden" name="upload" accept="image/*" >
              <input id="cover_image" type="text" class="hidden" name="cover_image" value=""  >
              <input id="prev_cover_image" type="text" class="hidden" name="prev_cover_image" value="<?php echo $listing['cover_image']; ?>"  >

          
        </div>
                </div>

                <div class="p-4 mb-4 w-full bg-gray-100 rounded-lg cursor-pointer dark:bg-gray-800">
                    <div class="w-full">
                        <label for="title" class="block my-2 text-sm font-bold text-gray-900 dark:text-white">Listing Title</label>
                        <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="<?php echo $listing['name']; ?>" placeholder="Type product name" required>
                    </div>

                    <div class="w-full">
                        <label for="price" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Price</label>
                        <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="<?php echo $listing['price']; ?>" placeholder="Ex. ₹2,999" required>
                    </div>
                    <div>
                        <label for="category" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Category</label>
                        <select id="category" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <?php 
                              // Fetch listings from the database
                                $sql = "SELECT * FROM `mb_categories` ORDER BY category_id DESC";
                                $result = mysqli_query($conn, $sql);
                                
                                
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row= mysqli_fetch_assoc($result)) {
                                        // Display the template for each listing
                                ?>
                                    <option value="<?php echo $row['category_slug'] ?>" <?php echo $listing['category_id'] == $row['category_slug'] ? 'selected' : ''; ?>><?php echo $row['category_name'] ?></option>
                                     
                                <?php };}; ?>

                            
</select>
</div>

<div class="w-full">
                    <label for="description" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Description</label>
                    <textarea name="description" id="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Add Additional Information about Your Product here..."><?php echo $listing['description']; ?></textarea>
                </div>
            </div>
            <div class="p-4 mb-4 w-full bg-gray-100 rounded-lg cursor-pointer dark:bg-gray-800">
                <div class="w-full">
                    <label for="phone" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Your Whatsapp Number</label>
                    <input type="tel" name="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="<?php echo $listing['seller_no']; ?>" placeholder="+91987654321" required pattern="[0-9]{10}">
                </div>
            </div>
            <div class="grid gap-4 mb-4 grid-cols-2 sm:gap-6 sm:mb-5 p-4 w-full bg-gray-100 rounded-lg cursor-pointer dark:bg-gray-800">
                <div class="w-full">
                    <label for="country" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Country</label>
                    <input type="text" name="country" id="country" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="<?php echo $listing['country']; ?>" placeholder="India" required>
                </div>
                <div class="w-full">
                    <label for="state" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">State</label>
                    <input type="text" name="state" id="state" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="<?php echo $listing['state']; ?>" placeholder="odisha" required>
                </div>
                <div class="w-full">
                    <label for="city" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">City</label>
                    <input type="text" name="city" id="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="<?php echo $listing['city']; ?>" placeholder="Cuttack" required>
                </div>
                <div class="w-full">
                    <label for="pincode" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Pincode</label>
                    <input type="number" name="pincode" id="pincode" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="<?php echo $listing['pincode']; ?>" placeholder="753001" required>
                </div>
            </div>

            <div class="flex items-center justify-center space-x-4">
                <button type="submit" id="submitbtn" name="submit" class="w-3/4 text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-primary-800">
                    Update Listing
                </button>
            </div>
        </form>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/compressorjs"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const uploadInput = document.getElementById('upload');
        const imagePreview = document.getElementById('image-preview');
        const coverImage = document.getElementById('cover_image');
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
            updateloader.style.display = 'block';  
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
</body>
</html>