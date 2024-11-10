<?php
require('require/global.php');
//start the session
session_start();
$seller_id= "";

$listing_id= ""; 

?>
<?php
    if(isset($_GET['id'])) {
      $id = $_GET['id'];
      $sql = "SELECT * FROM `mb_listings` WHERE listing_id = $id";
      $result = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($result);
    }
    if (mysqli_num_rows($result) > 0) {
        while ($row= mysqli_fetch_assoc($result)) {
      
  $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
  $seller_id= $row['seller_id'];
  $listing_id= $row['listing_id'];        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="15"> -->
    <title><?php echo $row['name']; ?></title>


<meta name="description" content="<?php echo $row['description'];?>">

<!-- Facebook Meta Tags -->
<meta property="og:url" content="<?php echo $hostname;?>/uploads/<?php echo $row['cover_image'];?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?php echo $row['name']; ?>">
<meta property="og:description" content="<?php echo $row['description']; ?>">
<meta property="og:image" content="<?php echo $hostname;?>/uploads/<?php echo $row['cover_image'];?>">

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta property="twitter:domain" content="<?php echo $domain;?>">
<meta property="twitter:url" content="<?php echo $hostname;?>/single.php?id=<?php echo $row['listing_id'];?>">
<meta name="twitter:title" content="Home decor ">
<meta name="twitter:description" content="<?php echo $row['description'];?>">
<meta name="twitter:image" content="<?php echo $hostname;?>/uploads/<?php echo $row['cover_image'];?>">

<!-- Meta Tags Generated via https://www.opengraph.xyz -->
   <?php require($host.'/require/tailwind.php'); ?>
</head>
<body class="dark:bg-gray-900" >
<?php include($host.'/components/header.php') ?>


<section class="p-2 bg-white dark:bg-gray-900 dark:text-white">
<div class="mx-auto mb-4 flex  flex-col gap-2 sm:flex-row max-w-screen-xl ">
          <div class="w-full md:w-2/6    ">
            <div class="w-full relative border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
              <img src="uploads/<?php echo $row['cover_image'];?>" id="cover_image" class="w-full h-[400px] object-cover lg:h-[450px] rounded-lg overflow-hidden" alt="Your Image" />
              <button class="absolute top-0 bg-blue-500 text-white p-2 rounded hover:bg-blue-800 m-2">Recently Posted</button>
            </div>
          </div>
          <div class="w-full flex flex-col justify-between md:w-4/6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 p-4">
          <div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?php echo $row['name']; ?></h5>
            <h3 class="mb-2  text-4xl font-bold tracking-tight text-gray-900 dark:text-white">₹<?php echo $row['price']; ?></h3>
            
            <div class="flex items-center mb-3">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1.5 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4c3.865 0 7 3.134 7 7 0 3.337-3 8-7 13-4-5-7-9.663-7-13 0-3.866 3.135-7 7-7zM12 6a2 2 0 100 4 2 2 0 000-4z" />
                  </svg>
                  <p class="font-normal text-gray-700 dark:text-gray-400 line-clamp-1 lg:line-clamp-2"><?php echo $row['city'] . ', ' . $row['state']; ?></p>
              </div>
          </div>
          <div class="md:flex gap-4 ">
          <a  href="message.php?seller-id=<?php echo $row['seller_id']; ?>&listing-id=<?php echo $row['listing_id']; ?>&user-id=<?php echo $user_id ?>" id="waButton"  >
          <div  class=" flex items-center justify-center gap-2 text-white bg-green-700 max-w-sm hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px"   viewBox="0 0 48 48" clip-rule="evenodd"><path fill="#fff" d="M4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98c-0.001,0,0,0,0,0h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303z"/><path fill="#fff" d="M4.868,43.803c-0.132,0-0.26-0.052-0.355-0.148c-0.125-0.127-0.174-0.312-0.127-0.483l2.639-9.636c-1.636-2.906-2.499-6.206-2.497-9.556C4.532,13.238,13.273,4.5,24.014,4.5c5.21,0.002,10.105,2.031,13.784,5.713c3.679,3.683,5.704,8.577,5.702,13.781c-0.004,10.741-8.746,19.48-19.486,19.48c-3.189-0.001-6.344-0.788-9.144-2.277l-9.875,2.589C4.953,43.798,4.911,43.803,4.868,43.803z"/><path fill="#cfd8dc" d="M24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5 M24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974 M24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974 M24.014,4C24.014,4,24.014,4,24.014,4C12.998,4,4.032,12.962,4.027,23.979c-0.001,3.367,0.849,6.685,2.461,9.622l-2.585,9.439c-0.094,0.345,0.002,0.713,0.254,0.967c0.19,0.192,0.447,0.297,0.711,0.297c0.085,0,0.17-0.011,0.254-0.033l9.687-2.54c2.828,1.468,5.998,2.243,9.197,2.244c11.024,0,19.99-8.963,19.995-19.98c0.002-5.339-2.075-10.359-5.848-14.135C34.378,6.083,29.357,4.002,24.014,4L24.014,4z"/><path fill="#40c351" d="M35.176,12.832c-2.98-2.982-6.941-4.625-11.157-4.626c-8.704,0-15.783,7.076-15.787,15.774c-0.001,2.981,0.833,5.883,2.413,8.396l0.376,0.597l-1.595,5.821l5.973-1.566l0.577,0.342c2.422,1.438,5.2,2.198,8.032,2.199h0.006c8.698,0,15.777-7.077,15.78-15.776C39.795,19.778,38.156,15.814,35.176,12.832z"/><path fill="#fff" fill-rule="evenodd" d="M19.268,16.045c-0.355-0.79-0.729-0.806-1.068-0.82c-0.277-0.012-0.593-0.011-0.909-0.011c-0.316,0-0.83,0.119-1.265,0.594c-0.435,0.475-1.661,1.622-1.661,3.956c0,2.334,1.7,4.59,1.937,4.906c0.237,0.316,3.282,5.259,8.104,7.161c4.007,1.58,4.823,1.266,5.693,1.187c0.87-0.079,2.807-1.147,3.202-2.255c0.395-1.108,0.395-2.057,0.277-2.255c-0.119-0.198-0.435-0.316-0.909-0.554s-2.807-1.385-3.242-1.543c-0.435-0.158-0.751-0.237-1.068,0.238c-0.316,0.474-1.225,1.543-1.502,1.859c-0.277,0.317-0.554,0.357-1.028,0.119c-0.474-0.238-2.002-0.738-3.815-2.354c-1.41-1.257-2.362-2.81-2.639-3.285c-0.277-0.474-0.03-0.731,0.208-0.968c0.213-0.213,0.474-0.554,0.712-0.831c0.237-0.277,0.316-0.475,0.474-0.791c0.158-0.317,0.079-0.594-0.04-0.831C20.612,19.329,19.69,16.983,19.268,16.045z" clip-rule="evenodd"/></svg>
            Chat With Seller
        </div>
        </a>

        <button data-modal-show="authentication-modal" id="offerbtn" class="w-full lg:w-2/4 flex items-center justify-center gap-2 text-white focus:outline-none text-white bg-yellow-500 hover:bg-yellow-400 focus:ring-2 focus:ring-yellow-300 font-bold text-center rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">Make Offer</button>

        </div>
              <?php 
                if($row['description']) {
                  $description= $row['description'];
                  echo '<div class="w-full flex flex-col justify-between  bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 p-4 max-w-screen-xl ">'; 
                  echo '<p id= "description" class="line-clamp-6">'. $description . '</p>';
                  
                  if(str_word_count($description) > 20){
                    
                    echo '<p id="readmore" class="readmore text-start font-bold underline cursor-pointer"> Read More</p></div>';
                  }else{
                    echo '</div>';
                  }
                }
                ?>
          
              

                
              
          </div>
        </div>
        
<?php }} ?>
  </section>
  
  
<script>
    const readmore = document.querySelector('#readmore');
    let readless = null; // Initialize readless variable outside of the if block
    const description = document.querySelector('#description');

    readmore.addEventListener('click', () => {
    description.classList.remove('line-clamp-6');
    readmore.innerHTML = "Read Less";
    readmore.id = 'readless';

    // Move this inside the click event listener of readmore
    readless = document.querySelector('#readless');
    if (readless) {
        readless.addEventListener('click', () => {
        description.classList.add('line-clamp-6');
        readmore.id = 'readmore';
        readless.innerHTML = 'Read More';
        readmore = document.querySelector('#readmore');
        if (readmore) {
        readmore.addEventListener('click', () => {
        description.classList.remove('line-clamp-6');
        readmore.innerHTML = "Read Less";
        readmore.id = 'readless';

        });
    }
        });
    }
    });

</script>

  


<section class="bg-white dark:bg-gray-900 w-full max-w-screen-xl dark:bg-gray-900 mx-auto p-4">
    <h1 class="flex py-5 dark:text-white  font-bold text-4xl text-gray-800">Related Products</h1>
<div class="flex flex-col bg-white m-auto p-auto max-w-screen-xl   mx-auto overflow-x-scroll dark:bg-gray-900">

      <div class=" pb-10 hide-scroll-bar max-w-screen-xl  mx-auto">
        <div class="flex flex-nowrap max-w-screen-xl  mx-auto ">

<?php 
// Fetch listings from the database
$sql = "SELECT * FROM `mb_listings` ORDER BY listing_id DESC LIMIT 6";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    while ($row= mysqli_fetch_assoc($result)) {
        // Display the template for each listing
        echo '
        
          <div class="inline-block px-1">
            <div
              class="w-[200px] h-full max-w-xs overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out"
            >
            <div class="max-w-sm  bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="single.php?id=' . $row['listing_id'] . '">
                <div class="w-full aspect-w-16 aspect-h-9">
                    <img src="uploads/' . $row['cover_image'] . '"  class="object-cover w-full h-full aspect-square" alt="Your Image">
                </div>
                </a>
                <div class="p-5">
                <a href="single.php?id=' . $row['listing_id'] . '">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">₹ ' . $row['price'] . '</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 line-clamp-1 ">' . $row['name'] . '</p>
                <div class="flex items-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1.5 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4c3.865 0 7 3.134 7 7 0 3.337-3 8-7 13-4-5-7-9.663-7-13 0-3.866 3.135-7 7-7zM12 6a2 2 0 100 4 2 2 0 000-4z" />
                    </svg>
                    <p class="font-normal text-gray-700 dark:text-gray-400 line-clamp-1 "">' . $row['city'] . ', ' . $row['state'] . '</p>
                </div>
                <a href="single.php?id=' . $row['listing_id'] . '" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800  ">
                    <span class="line-clamp-1 ">Check Details</span>
                    
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
                      </div>
                  </div>
              
              </div>
          </div>
'; 
  } 
}

?>
        </div>
      </div>
</div>
</section>
<style>
.hide-scroll-bar {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
.hide-scroll-bar::-webkit-scrollbar {
  display: none;
}
</style>
<!-- Main modal -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true" class="overflow-y-auto hidden overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full flex">
  <div class="relative max-h-full w-full max-w-md p-4">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Make Offer
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <div class="space-y-4">
  <form id="offerForm" class="space-y-4" method="get" action="/mobazaar/message.php">
    <div>
      <label for="offer_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Offer Price</label>
      
    <input type="hidden" name="seller-id" id="seller_id" value="<?php echo $seller_id; ?>">
    <input type="hidden" name="listing-id" id="listing_id" value="<?php echo $listing_id; ?>">
    <input type="hidden" name="user-id" id="user_id" value="<?php echo $user_id; ?>">
    <input type="number" name="offer-price" id="offer_price" placeholder="999" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
    </div>

    <button type="submit" class="w-full focus:outline-none text-white bg-yellow-500 hover:bg-yellow-400 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">Make Offer</button>
  </form>
</div>

            </div>
        </div>
    </div>
</div> 
<script>
document.addEventListener('DOMContentLoaded', (event) => {
  const modal = document.getElementById('authentication-modal');
  const showModalButton = document.querySelector('[data-modal-show="authentication-modal"]');
  const closeModalButton = modal.querySelector('[data-modal-hide="authentication-modal"]');

  // Function to show the modal
  const showModal = () => {
    modal.classList.remove('hidden');
    modal.setAttribute('aria-hidden', 'false');
  };

  // Function to hide the modal
  const hideModal = () => {
    modal.classList.add('hidden');
    modal.setAttribute('aria-hidden', 'true');
  };

  // Show modal when the show button is clicked
  if (showModalButton) {
    showModalButton.addEventListener('click', showModal);
  }

  // Hide modal when the close button is clicked
  closeModalButton.addEventListener('click', hideModal);

  // Hide modal when clicking outside the modal content
  window.addEventListener('click', (event) => {
    if (event.target === modal) {
      hideModal();
    }
  });
});

</script>
</body>
</html>
