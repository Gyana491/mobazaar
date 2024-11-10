<?php
require('require/global.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="15"> -->
    <title>My Lisitngs</title>
   <?php require($host.'/require/tailwind.php'); ?>
</head>
<body class="bg-white dark:bg-gray-900">
<?php include($host.'/components/header.php') ?>

    <h1 class="text-2xl text-center font-bold tracking-tight text-gray-900 dark:text-white my-4">My Listings</h1>

<section class="mx-auto max-w-screen-lg justify-center  bg-white p-4 dark:bg-gray-900">

 <?php 
 $count= 10;
 for($i=0;$i<$count;$i++){?>
    
        <div id="34" class="flex w-full flex-row rounded-lg border border-gray-200 bg-white shadow dark:border-gray-700 dark:bg-gray-800 mb-4">
            <a href="#">
            <div class="w-full h-full flex flex-row items-center justify-center">
                <img src="https://rukminim2.flixcart.com/image/832/832/xif0q/shoe/t/8/t/6-grey-6-roaster-grey-original-imagwfzwyq3wyfch.jpeg?q=70&crop=false" class="aspect-square w-48 object-cover md:w-56" alt="Your Image" />
            </div>
            </a>
            <div class="p-5">
            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">₹ 350</h5>
            </a>
            <p class="mb-3 line-clamp-1 font-normal text-gray-700 lg:line-clamp-2 dark:text-gray-400">Female Shoes at 350 Rupees</p>
            <div class="mb-3 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-1.5 h-4 w-4 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4c3.865 0 7 3.134 7 7 0 3.337-3 8-7 13-4-5-7-9.663-7-13 0-3.866 3.135-7 7-7zM12 6a2 2 0 100 4 2 2 0 000-4z" />
                </svg>
                <p class="line-clamp-1 font-normal text-gray-700 lg:line-clamp-2 dark:text-gray-400">Cuttack, Odisha</p>
            </div>
            <div class="flex flex-row justify-between gap-2">
                <a href="#" class="inline-flex items-center rounded-lg bg-blue-700 px-3 py-2 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <span class="line-clamp-1">Edit Listing</span>
                </a>
                <button data-list-id="<?php echo $i; ?>" data-modal-show="popup-modal" id="delete-toggle" class="inline-flex items-center rounded-lg bg-red-700 px-3 py-2 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 ">
                    <span class="line-clamp-1">Delete Listing</span>
            </button>
         </div>
            </div>
        </div>

 
 <?php }?>
 

</section >
<div id="popup-modal" tabindex="-1" class="overflow-y-auto hidden overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full flex">
  <div class="relative max-h-full w-full max-w-md p-4">
    <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
      <button type="button" class="absolute end-2.5 top-3 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
        <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
        <span class="sr-only">Close modal</span>
      </button>
      <div class="p-4 text-center md:p-5">
        <svg class="mx-auto mb-4 h-12 w-12 text-gray-400 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
        <button data-modal-hide="popup-modal" type="button" class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:focus:ring-red-800">Yes, I'm sure</button>
        <button data-modal-hide="popup-modal"  type="button" class="ms-3 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">No, cancel</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    
  });
    function updateUrlParameter(key, value) {
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set(key, value);
    window.history.replaceState({}, '', `${window.location.origin}${window.location.pathname}?${urlParams.toString()}`);
    }
    const deletePopupTrigger = document.querySelectorAll('button[data-modal-show="popup-modal"]'); 
    // Assuming class for buttons

    console.log(deletePopupTrigger);

    const deleteModal = document.getElementById('popup-modal');

    deletePopupTrigger.forEach(button => { 
        // Use forEach to iterate over multiple buttons
        button.addEventListener('click', () => {
        deleteModal.classList.remove('hidden'); // Directly target deleteModal
        const id = button.getAttribute('data-list-id');
        updateUrlParameter('id', id );
        deleteModal.setAttribute('data-list-id', '56'); // Add data-list-id attribute on click
    });
    });

    // Assuming you have a close button with data-modal-hide="popup-modal"
    const closeButton = document.querySelector('button[data-modal-hide="popup-modal"]');

    closeButton.addEventListener('click', function() {
    deleteModal.classList.add('hidden');
    // Optionally, remove the 'id' parameter from the URL on close
    window.history.replaceState({}, '', `${window.location.origin}${window.location.pathname}`);
    });

</script>

</body>
</html>
