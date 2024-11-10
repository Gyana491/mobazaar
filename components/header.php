
<style>
  .font-chewy {
  font-family: "Chewy", system-ui;
  font-weight: 400;
  font-style: normal;
}

  @media (prefers-color-scheme: dark) {
    .svg-body {
      stroke: white; /* Change color on hover and active */
      fill:white; 
      color:white;
      }
      a:active {
      stroke: #14b8a6 !important; /* Change color on hover and active */
      fill:#14b8a6 !important;
      color:#14b8a6 !important;
   }
  
  }

  .svg-body:hover , a:active {
      stroke: #14b8a6; /* Change color on hover and active */
      fill:#14b8a6;
      color:#14b8a6;
   }
   
 img[alt*="000webhost"],img[alt*='www.000webhost.com'],
img[alt*="000webhost"][style],
img[src*="000webhost"],
img[src*="000webhost"][style]{
opacity: 0 !important;
pointer-events:none !important;
width: 0px !important;
height: 0px !important;
visibility:hidden !important;
display:none !important;
}
  
  </style>
<nav class=" bg-white drop-shadow-lg shadow-1 border-gray-200 py-2.5 dark:bg-gray-900">
  <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
    <a href="/mobazaar" class="flex items-center">
      <div class="w-full h-full px-1 flex justify-between items-center bg-white rounded-lg overflow-hidden dark:bg-gray-900">
        <div class="h-full bg-indigo-600 rounded-md flex flex-col justify-between items-center">
          <div class="w-full h-3/4 px-2 py-1 text-white text-[32px] font-chewy font-bold  leading-none">ମୋ</div>
        </div>
        <div class="px-2 py-1  h-full text-black text-[34px] font-chewy font-bold  underline leading-none dark:text-white">Bazaar</div>
      </div>
    </a>
    
    <!-- <a href="/mobazaar/create-listing" class="text-white bg-purple-800 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-bold rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 sm:mr-2 lg:mr-0 dark:bg-purple-600 dark:hover:bg-purple-700 focus:outline-none dark:focus:ring-purple-800">+ Sell Anything</a> -->
    
    <a href="/mobazaar/create-listing">
    <button class="relative inline-flex items-center justify-center p-0.5  overflow-hidden  rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
      <span  class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-bold rounded-lg text-sm px-5 py-2.5 text-center ">+ Sell Anything</span>
      </button>
    </a>
    
    
  </div>
  <div class="mt-4 mb-2  px-4 mx-auto max-w-screen-xl ">
    <form class="max-w-full mx-auto " action="/mobazaar/search.php" >   
      <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
      <div class="relative">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
              <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
              </svg>
          </div>
          <input type="search" name="query" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Mobiles, Laptops..."  />
          <button type="submit" id="search-button" class="text-white absolute end-2.5 bottom-2.5 bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
      </div>
    </form>
  </div>

</nav>


	<section id="bottom-navigation" class="block  fixed inset-x-0 bottom-0 z-10 bg-white dark:bg-gray-900 shadow  ">
		<div id="tabs" class="flex justify-between mx-auto max-w-screen-xl px-4">
			<a href="/mobazaar/" class="svg-body w-full focus:text-teal-500 justify-center inline-block text-center pt-2 pb-1 ">
				
        <svg xmlns="http://www.w3.org/2000/svg" class=" inline-block mb-1 "width="25" height="25" viewBox="0 0 24 24" id="home"><path  d="M6.63477851,18.7733424 L6.63477851,15.7156161 C6.63477851,14.9350667 7.27217143,14.3023065 8.05843544,14.3023065 L10.9326107,14.3023065 C11.310188,14.3023065 11.6723007,14.4512083 11.9392882,14.7162553 C12.2062757,14.9813022 12.3562677,15.3407831 12.3562677,15.7156161 L12.3562677,18.7733424 C12.3538816,19.0978491 12.4820659,19.4098788 12.7123708,19.6401787 C12.9426757,19.8704786 13.2560494,20 13.5829406,20 L15.5438266,20 C16.4596364,20.0023499 17.3387522,19.6428442 17.9871692,19.0008077 C18.6355861,18.3587712 19,17.4869804 19,16.5778238 L19,7.86685918 C19,7.13246047 18.6720694,6.43584231 18.1046183,5.96466895 L11.4340245,0.675869015 C10.2736604,-0.251438297 8.61111277,-0.221497907 7.48539114,0.74697893 L0.967012253,5.96466895 C0.37274068,6.42195254 0.0175522924,7.12063643 0,7.86685918 L0,16.568935 C0,18.4638535 1.54738155,20 3.45617342,20 L5.37229029,20 C6.05122667,20 6.60299723,19.4562152 6.60791706,18.7822311 L6.63477851,18.7733424 Z" transform="translate(2.5 2)"></path></svg>
				<span class="tab tab-home block text-xs">Home</span>
			</a>
			<a href="/mobazaar/categories" class="svg-body w-full focus:text-teal-500 hover:text-teal-500 justify-center inline-block text-center pt-2 pb-1">
				<svg width="25" height="25" viewBox="0 0 42 42"  class="inline-block mb-1">
			    
            <path d="M8.5,1 C4.35786438,1 1,4.35786438 1,8.5 L1,13 C1,14.6568542 2.34314575,16 4,16 L13,16 C14.6568542,16 16,14.6568542 16,13 L16,4 C16,2.34314575 14.6568542,1 13,1 L8.5,1 Z" stroke-width="2"></path>
		            <path d="M4,20 C2.34314575,20 1,21.3431458 1,23 L1,27.5 C1,31.6421356 4.35786438,35 8.5,35 L13,35 C14.6568542,35 16,33.6568542 16,32 L16,23 C16,21.3431458 14.6568542,20 13,20 L4,20 Z"  stroke-width="2"></path>
		            <path d="M23,1 C21.3431458,1 20,2.34314575 20,4 L20,13 C20,14.6568542 21.3431458,16 23,16 L32,16 C33.6568542,16 35,14.6568542 35,13 L35,8.5 C35,4.35786438 31.6421356,1 27.5,1 L23,1 Z"  stroke-width="2"></path>
		            <path d="M34.5825451,33.4769886 L38.3146092,33.4322291 C38.8602707,33.4256848 39.3079219,33.8627257 39.3144662,34.4083873 C39.3145136,34.4123369 39.3145372,34.4162868 39.3145372,34.4202367 L39.3145372,34.432158 C39.3145372,34.9797651 38.8740974,35.425519 38.3265296,35.4320861 L34.5944655,35.4768456 C34.048804,35.4833899 33.6011528,35.046349 33.5946085,34.5006874 C33.5945611,34.4967378 33.5945375,34.4927879 33.5945375,34.488838 L33.5945375,34.4769167 C33.5945375,33.9293096 34.0349773,33.4835557 34.5825451,33.4769886 Z" fill="currentColor" transform="translate(36.454537, 34.454537) rotate(-315.000000) translate(-36.454537, -34.454537) "></path>
		            <circle  stroke-width="2" cx="27.5" cy="27.5" r="7.5"></circle>
		    	
				</svg>
				<span class="tab tab-kategori block text-xs">Categories</span>
			</a>
			<a href="/mobazaar/create-listing" class="w-full svg-body focus:text-teal-500 hover:text-teal-500 justify-center inline-block text-center pt-2 pb-1">
				<svg class=" inline-block mb-1"  width="25" height="25" xmlns=" http://www.w3.org/2000/svg"  viewBox="0 0 24 24" id="plus"><path  d="M14.6602,0.0001 C18.0602,0.0001 20.0002,1.9201 20.0002,5.3301 L20.0002,5.3301 L20.0002,14.6701 C20.0002,18.0601 18.0702,20.0001 14.6702,20.0001 L14.6702,20.0001 L5.3302,20.0001 C1.9202,20.0001 0.0002,18.0601 0.0002,14.6701 L0.0002,14.6701 L0.0002,5.3301 C0.0002,1.9201 1.9202,0.0001 5.3302,0.0001 L5.3302,0.0001 Z M9.9902,5.5101 C9.5302,5.5101 9.1602,5.8801 9.1602,6.3401 L9.1602,6.3401 L9.1602,9.1601 L6.3302,9.1601 C6.1102,9.1601 5.9002,9.2501 5.7402,9.4001 C5.5902,9.5601 5.5002,9.7691 5.5002,9.9901 C5.5002,10.4501 5.8702,10.8201 6.3302,10.8301 L6.3302,10.8301 L9.1602,10.8301 L9.1602,13.6601 C9.1602,14.1201 9.5302,14.4901 9.9902,14.4901 C10.4502,14.4901 10.8202,14.1201 10.8202,13.6601 L10.8202,13.6601 L10.8202,10.8301 L13.6602,10.8301 C14.1202,10.8201 14.4902,10.4501 14.4902,9.9901 C14.4902,9.5301 14.1202,9.1601 13.6602,9.1601 L13.6602,9.1601 L10.8202,9.1601 L10.8202,6.3401 C10.8202,5.8801 10.4502,5.5101 9.9902,5.5101 Z" transform="translate(2 2)"></path></svg>
        <span class="tab tab-explore block text-xs">New List</span>
			</a>
			<a href="/mobazaar/my-listing" class="w-full svg-body focus:text-teal-500 hover:text-teal-500 justify-center inline-block text-center pt-2 pb-1">

        <svg class=" inline-block mb-1" width="28" height="25" viewBox="0 0 42 42"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" id="list"><path  d="M31.544 12.932a1.5 1.5 0 0 1 1.5-1.5h18.87a1.5 1.5 0 0 1 0 3h-18.87a1.5 1.5 0 0 1-1.5-1.5Zm20.37 4.841h-22.87a1.5 1.5 0 0 0 0 3h22.87a1.5 1.5 0 0 0 0-3Zm0 10.727h-18.87a1.5 1.5 0 1 0 0 3h18.87a1.5 1.5 0 0 0 0-3Zm0 6.343h-22.87a1.5 1.5 0 1 0 0 3h22.87a1.5 1.5 0 0 0 0-3ZM20.77 26.16h-8.68a1.5 1.5 0 0 0-1.5 1.5v8.68a1.5 1.5 0 0 0 1.5 1.5h8.68a1.5 1.5 0 0 0 1.5-1.5v-8.68a1.5 1.5 0 0 0-1.5-1.5Zm0-17.07h-8.68a1.5 1.5 0 0 0-1.5 1.5v8.68a1.5 1.5 0 0 0 1.5 1.5h8.68a1.5 1.5 0 0 0 1.5-1.5v-8.68a1.5 1.5 0 0 0-1.5-1.5Zm0 34.14h-8.68a1.5 1.5 0 0 0-1.5 1.5v8.68a1.5 1.5 0 0 0 1.5 1.5h8.68a1.5 1.5 0 0 0 1.5-1.5v-8.68a1.5 1.5 0 0 0-1.5-1.5Zm31.144 2.338h-18.87a1.5 1.5 0 1 0 0 3h18.87a1.5 1.5 0 0 0 0-3Zm0 6.343h-22.87a1.5 1.5 0 1 0 0 3h22.87a1.5 1.5 0 0 0 0-3Z"></path></svg>
				<span class="tab tab-whishlist block text-xs">My Listings</span>
			</a>
			<a href="/mobazaar/profile-setup.php"  class="svg-body w-full  focus:text-teal-500 hover:text-teal-500 justify-center inline-block text-center pt-2 pb-1">
				<!-- <svg width="25" height="25" viewBox="0 0 42 42" class="inline-block mb-1">
			    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
		        <path d="M14.7118754,20.0876892 L8.03575361,20.0876892 C5.82661462,20.0876892 4.03575361,18.2968282 4.03575361,16.0876892 L4.03575361,12.031922 C4.03575361,8.1480343 6.79157254,4.90780265 10.4544842,4.15995321 C8.87553278,8.5612583 8.1226025,14.3600511 10.9452499,15.5413938 C13.710306,16.6986332 14.5947501,18.3118357 14.7118754,20.0876892 Z M14.2420017,23.8186831 C13.515543,27.1052019 12.7414284,30.2811559 18.0438552,31.7330419 L18.0438552,33.4450645 C18.0438552,35.6542035 16.2529942,37.4450645 14.0438552,37.4450645 L9.90612103,37.4450645 C6.14196811,37.4450645 3.09051926,34.3936157 3.09051926,30.6294627 L3.09051926,27.813861 C3.09051926,25.604722 4.88138026,23.813861 7.09051926,23.813861 L14.0438552,23.813861 C14.1102948,23.813861 14.1763561,23.8154808 14.2420017,23.8186831 Z M20.7553776,32.160536 C23.9336213,32.1190063 23.9061943,29.4103976 33.8698747,31.1666916 C34.7935223,31.3295026 35.9925894,31.0627305 37.3154077,30.4407183 C37.09778,34.8980343 33.4149547,38.4450645 28.9036761,38.4450645 C24.9909035,38.4450645 21.701346,35.7767637 20.7553776,32.160536 Z" fill="currentColor" opacity="0.1"></path>
		        <g transform="translate(2.000000, 3.000000)">
		            <path d="M8.5,1 C4.35786438,1 1,4.35786438 1,8.5 L1,13 C1,14.6568542 2.34314575,16 4,16 L13,16 C14.6568542,16 16,14.6568542 16,13 L16,4 C16,2.34314575 14.6568542,1 13,1 L8.5,1 Z" stroke="currentColor" stroke-width="2"></path>
		            <path d="M4,20 C2.34314575,20 1,21.3431458 1,23 L1,27.5 C1,31.6421356 4.35786438,35 8.5,35 L13,35 C14.6568542,35 16,33.6568542 16,32 L16,23 C16,21.3431458 14.6568542,20 13,20 L4,20 Z" stroke="currentColor" stroke-width="2"></path>
		            <path d="M23,1 C21.3431458,1 20,2.34314575 20,4 L20,13 C20,14.6568542 21.3431458,16 23,16 L32,16 C33.6568542,16 35,14.6568542 35,13 L35,8.5 C35,4.35786438 31.6421356,1 27.5,1 L23,1 Z" stroke="currentColor" stroke-width="2"></path>
		            <path d="M34.5825451,33.4769886 L38.3146092,33.4322291 C38.8602707,33.4256848 39.3079219,33.8627257 39.3144662,34.4083873 C39.3145136,34.4123369 39.3145372,34.4162868 39.3145372,34.4202367 L39.3145372,34.432158 C39.3145372,34.9797651 38.8740974,35.425519 38.3265296,35.4320861 L34.5944655,35.4768456 C34.048804,35.4833899 33.6011528,35.046349 33.5946085,34.5006874 C33.5945611,34.4967378 33.5945375,34.4927879 33.5945375,34.488838 L33.5945375,34.4769167 C33.5945375,33.9293096 34.0349773,33.4835557 34.5825451,33.4769886 Z" fill="currentColor" transform="translate(36.454537, 34.454537) rotate(-315.000000) translate(-36.454537, -34.454537) "></path>
		            <circle stroke="currentColor" stroke-width="2" cx="27.5" cy="27.5" r="7.5"></circle>
		        </g>
		    	</g>
				</svg> -->
				<svg width="25" height="25"  class="inline-block " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" id="account"><path d="M16,2A14,14,0,1,0,30,16,14,14,0,0,0,16,2ZM10,26.39a6,6,0,0,1,11.94,0,11.87,11.87,0,0,1-11.94,0Zm13.74-1.26a8,8,0,0,0-15.54,0,12,12,0,1,1,15.54,0ZM16,8a5,5,0,1,0,5,5A5,5,0,0,0,16,8Zm0,8a3,3,0,1,1,3-3A3,3,0,0,1,16,16Z"></path></svg>

        <span class="tab tab-account block text-xs">Account</span>
			</a>
		</div>
	</section>










