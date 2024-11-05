<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible " content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
 <?php require('inc/link.php');?>
 <title> <?php echo $settings_r['site_title'] ?> ABOUT</title>
 
 <style>
    .box{
        border-top-color: var(--teal) !important;
    }
 </style>

</head>
<body class="bg-light">

   <?php require('inc/header.php');?>

   <div class="my-5 px-4">
      <h2 class="fw-bold h-font text-center">ABOUT US</h2>
       <p class="text-center mt-3">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
        Odio vero cupiditate libero. Dolores aliquam at qui.
       </p>
   </div>

  <!--image -->

   <div class="container">
    <div class="row justify-content-between align-items-center">
        <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
            <h3 class="mb-3">Lorem ipsum dolor sit.</h3>
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
             Asperiores facilis eum et, nisi voluptatem exercitationem temporibus.
             Lorem ipsum dolor sit amet consectetur adipisicing elit.
             Asperiores facilis eum et, nisi voluptatem exercitationem temporibus.
        </div>
        <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
            <img src="images/about/1.jpg" class="w-50 h-70">

        </div>
    </div>
   </div>

   <!-- cardimage -->

   <div class="container mt-5">
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center box ">
                <img src="images/about/hostel.png" width="70px""">
                <h4 class="mt-3"> 100 ROOMS </h4>
            </div>

        </div>
        <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center box ">
                <img src="images/about/customer.png" width="70px""">
                <h4 class="mt-3"> 100+ Custumer </h4>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center box ">
                <img src="images/about/ratings.png" width="70px""">
                <h4 class="mt-3"> 100+ REVIEWS </h4>
            </div>

        </div>
        <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center box ">
                <img src="images/about/staff.png" width="70px""">
                <h4 class="mt-3"> 10 STAFFS </h4>
            </div>

        </div>
        
    </div>
   </div>

   <h3 class="my-3 h-font text-center">MANAGEMENT TEAM</h3>

   <div class="container px-4">
     <!-- Swiper -->
  <div class="swiper mySwiper">
    <div class="swiper-wrapper mb-5">
      
    <?php 
     $about_r = selectAll('team_details');
     $path = ABOUT_IMG_PATH;

     while($row = mysqli_fetch_assoc($about_r)){
      echo <<< data
        <div class="swiper-slide bg-whte text-center overflow-hidden rounded ">
          <img src="$path$row[picture]" class="w-25 h-50">
          <h5 class="mt-2">$row[name]</h5>
        </div>

      data;
     }
    ?>
    </div>
    <div class="swiper-pagination"></div>
  </div>

   </div>




    <?php require('inc/footer.php');?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <!-- script for Swiper about -->
            <script>
                var swiper = new Swiper(".mySwiper", {
                
                spaceBetween:40,
                pagination: {
                    el: ".swiper-pagination",
                },
                breakpoints: {
                  320:{
                    slidesPerView: 1,
                  },
                  640:{
                    slidesPerView: 1,
                  },
                  7680:{
                    slidesPerView: 3,
                  },
                  1024:{
                    slidesPerView: 3,
                  },
                }
                });
            </script>
  
    </body>
</html>