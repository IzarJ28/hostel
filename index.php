<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible " content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
 <?php require('inc/link.php');?>
 <title> <?php echo $settings_r['site_title'] ?> HOME</title>

 <style>
    .availability-form{
        margin-top: -50px;
        z-index: 2;
        position: relative;
    }

    @media screen and (max-width: 575px){
        .availability-form{
            margin-top: 25px;
            padding: 0 35px;
    }
    }
    </style>

</head>
<body class="bg-light">

   <?php require('inc/header.php');?>

     <!-- Hostel image background -->

    <div class="container-fluid px-lg-4 mt-4">
    <div class="swiper swiper-container">
    <div class="swiper-wrapper">
        
      <!-- Swiper -->
        <?php 
         $res = selectAll('hostel');
         while ($row = mysqli_fetch_assoc($res))
         {
            $path = HOSTEL_IMG_PATH;
            echo <<< data
            <div class="swiper-slide">
                <img src="$path$row[image]" class="w-100 d-block" />
            </div>
            
            data;
         }
        ?>

            </div>
           
        </div>
    
    </div>

     <!-- Availability form -->
    <div class="container availability-form">
        <div class="class-row">
            <div class="class-lg-12 bg-white shadow p-4 rounded">
                <h5 class="mb-4">Check Booking Availability </h5>
                <form>
                    <div class="row align-items-end">
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight :500;">Check-in</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight :500;">Check-out</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight :500;">Adult</label>
                            <select class="form-select shadow-none">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label class="form-label" style="font-weight :500;">Children</label>
                            <select class="form-select shadow-none">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-1 mb-lg-3 mt-2">
                            <button type="submit" class="btn text-white shadow-none custom-bg">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Rooms -->
     <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">ROOMS</h2>
     <div class="container">
        <div class="row">

  <!-- script for showing a data in card about roomn  -->
  <?php 
        $res = selectAll('types_room');
        $path = TYPESROOM_IMG_PATH; // The path where the images are stored
        while($row = mysqli_fetch_assoc($res)) {
            echo <<<data
                <div class="col-lg-6 col-md-6 my-3">
                    <div class="card border-0 shadow" style="max-width: 550px; margin: auto;">
                        <img src="$path$row[image]" class="card-img-top" alt="$row[name]">
                        <div class="card-body">
                            <h5>$row[name]</h5>
                            <div class="mb-4">
                                <h6 class="mb-1">$row[description]</h6>
                            </div>
                            <div class="d-flex justify-content-evenly mb-2">
                                <a href="room.php?id=$row[id]" class="btn btn-sm btn-outline-danger shadow-none">See Rooms</a>
                            </div>
                        </div>
                    </div>
                </div>
            data;
        }
?>






        
     <!-- script for showing a data in card about roomn 
        <?php 
            $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=?  ORDER BY `id` DESC LIMIT 3", [1, 0], 'ii');

            while ($room_data = mysqli_fetch_assoc($room_res)) {
                // Get features of room 
                $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f 
                    INNER JOIN `room_features` rfea ON f.id = rfea.features_id 
                    WHERE rfea.room_id = '$room_data[id]'");

                $features_data = "";
                while ($fea_row = mysqli_fetch_assoc($fea_q)) {
                    $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>$fea_row[name]</span>";
                }

                // Get facilities of room 
                $fac_q = mysqli_query($con, "SELECT f.name FROM `facilities` f 
                    INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id 
                    WHERE rfac.room_id = '$room_data[id]'");

                $facilities_data = "";
                while ($fac_row = mysqli_fetch_assoc($fac_q)) {
                    $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>$fac_row[name]</span>";
                }

                // Get thumbnail of image
                $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
                $thumb_q = mysqli_query($con, "SELECT * FROM `room_image` WHERE `room_id`='$room_data[id]' AND `thumb`='1'");

                if (mysqli_num_rows($thumb_q) > 0) {
                    $thumb_res = mysqli_fetch_assoc($thumb_q);
                    $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
                }

                // Check user type from session
                $price_display = '';
                if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] === 'external') {
                    // Show the price for external users only
                    $price_display = "<h6 class='mb-4'>₱$room_data[price] per Day/Night</h6>";
                }

                // Print room card

                 $book_btn = "";

                if (!$settings_r['shutdown']){

                    ///login before book
                    $login=0;
                    if (isset($_SESSION['login']) && $_SESSION['login']=true){
                        $login=1;
                    }
                    
                    ///show if not shutdown
                    $book_btn ="<button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-sm text-white custom-bg shadow-none'>Book Now</button>";
                }


                echo <<<data
                    <div class="col-lg-4 col-md-6 my-3">
                        <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                            <img src="$room_thumb" class="card-img-top">
                            <div class="card-body">
                                <h5>$room_data[name]</h5>
                                $price_display
                                <div class="features mb-4">
                                    <h6 class="mb-1">Description</h6>
                                    $features_data
                                </div>
                                <div class="facilities mb-4">
                                    <h6 class="mb-1">Facilities</h6>
                                    $facilities_data
                                </div>
                                <div class="guest mb-4">
                                    <h6 class="mb-1">Guest</h6>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">$room_data[adult] Adults</span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">$room_data[children] Children</span>
                                </div>
                                <div class="rating mb-4">
                                    <h6 class="mb-1">Ratings</h6>
                                    <span class="badge rounded-pill bg-light">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                    </span>
                                </div>
                                <div class="d-flex justify-content-evenly mb-2">
                                    $book_btn
                                    <a href="room_details.php?id=$room_data[id]" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                data;
            }
        ?> -->
         
            <div class="col-lg-12 text-center mt-5">
              <a href="room_details.php" class="btn btn-sm btn-outline-danger rounded-0 fw-bold shadow-none">More Rooms >>></a>
            </div>
        </div>
     </div>





     <!-- Banguet -->
     <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">BANGUET STYLE</h2>
     <div class="container">
                  <!-- more details of room images  -->
        <div class="col-lg-7 col-md-12 px-4">
          <div id="roomHostel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                
                <!-- more details of room images  -->
                <?php 

                    $room_img = ROOMS_IMG_PATH."thumbnail.jpg";
                    $img_q = mysqli_query($con,"SELECT * FROM `room_image` 
                    WHERE `room_id`='$room_data[id]'");
          
                      if (mysqli_num_rows($img_q)>0)
                      {
                        $active_class = 'active';

                      while ($img_res = mysqli_fetch_assoc($img_q))
                        {
                            echo "<div class='carousel-item $active_class'>
                            <img src='".ROOMS_IMG_PATH.$img_res['image']."' class='d-block w-100 rounded'>
                          </div>
                            ";
                          $active_class = '';
                        }
                    

                      }
                      else{
                        echo " <div class='carousel-item active'>
                                <img src='$room_img' class='d-block w-100'>
                              </div>";

                      }

                ?>

            </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#roomHostel" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#roomHostel" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
          </div>
        </div>
     </div>


          <!-- Facilities -->
          <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">FACILITIES</h2>
     <div class="container">
            <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">

            <?php 
              $res = mysqli_query($con,"SELECT * FROM `facilities` ORDER BY `id` DESC  LIMIT 5");
              $path = FACILITIES_IMG_PATH;

              while($row = mysqli_fetch_assoc($res)) {
                echo <<<data
                    <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                        <img src="$path$row[icon]" width="60px">
                        <h5 class="mt-3">$row[name]</h5>
                    </div>

               data;
              }
            ?>

                <div class="col-lg-12 text-center mt-5">
                    <a href="facilities.php" class="btn btn-sm btn-outline-danger rounded-0 fw-bold shadow-none">More Facilities >>></a>
                </div>            
            </div>
     </div>

      <!-- Testimonials -->
      <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">TESTIMONIALS</h2>
       <div class="container mt-5">
        <!-- Swiper -->
            <div class="swiper swipertest">
                <div class="swiper-wrapper mb-5">

                 <div class="swiper-slide bg-white p-4">
                  <div class="profile d-flex align-items-center mb-3">
                    <img src="images/profile/1.svg " width="30px">
                    <h6 class="m-0 ms-2">Emmanuel Laparan</h6>
                  </div>
                   <p>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                     Ipsa, eveniet dolorum voluptatibus et quibusdam quisquam? 
                     Velit aliquam saepe nisi adipisci ex corporis reprehenderit,
                     sequi at molestias temporibus impedit atque placeat!
                   </p>
                   <div class="rating">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                   </div>
                 </div>

                 <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                      <img src="images/profile/1.svg " width="30px">
                      <h6 class="m-0 ms-2">Emmanuel Laparan</h6>
                    </div>
                     <p>
                     Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                     Ipsa, eveniet dolorum voluptatibus et quibusdam quisquam?
                      Velit aliquam saepe nisi adipisci ex corporis reprehenderit,
                     sequi at molestias temporibus impedit atque placeat!
                     </p>
                     <div class="rating">
                      <i class="bi bi-star-fill text-warning"></i>
                      <i class="bi bi-star-fill text-warning"></i>
                      <i class="bi bi-star-fill text-warning"></i>
                      <i class="bi bi-star-fill text-warning"></i>
                     </div>
                 </div>

                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                      <img src="images/profile/1.svg " width="30px">
                      <h6 class="m-0 ms-2">Emmanuel Laparan</h6>
                    </div>
                     <p>
                     Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                     Ipsa, eveniet dolorum voluptatibus et quibusdam quisquam? 
                     Velit aliquam saepe nisi adipisci ex corporis reprehenderit,
                     sequi at molestias temporibus impedit atque placeat!
                     </p>
                     <div class="rating">
                      <i class="bi bi-star-fill text-warning"></i>
                      <i class="bi bi-star-fill text-warning"></i>
                      <i class="bi bi-star-fill text-warning"></i>
                      <i class="bi bi-star-fill text-warning"></i>
                     </div>
                   </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="col-lg-12 text-center mt-5">
                <a href="about.php" class="btn btn-sm btn-outline-danger rounded-0 fw-bold shadow-none">Know More >>></a>
            </div> 
       </div>

    <!-- Reach Us --->



    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">REACH US</h2>
    <div class="container">
       <div class="row">
        <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
            <iframe class="w-100 rounded" height="320px" src="<?php echo $contact_r['iframe'] ?>" loading= "lazy"></iframe>
        </div>
        <div class="col-lg-4 col-md-4 ">
           <div class="bg-white p-4 rounded mb-4">
            <h5>Call Us</h5>
            <a href="tel: +<?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
                <i class="bi bi-telephone-fill"></i> +<?php echo $contact_r['pn1'] ?>
            </a>
            <br>
            <?php 
              if ($contact_r['pn2']!=''){
                echo <<< data
                    <a href="tel: +$contact_r[pn2]" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i> +$contact_r[pn2]
                    </a>
                data;
              }
            ?>
         
           </div>
           <div class="bg-white p-4 rounded mb-4">
            <h5>Follow  Us</h5>
   
            <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block mb-3">
                <span class="badge bg-light text-dark fs-6 p-2">
                 <i class="bi bi-facebook m-1"></i> Facebook
                </span>
             </a>
         
           </div>
        </div>
       </div>
    </div>


    <!-- password reset modal  -->

    <div class="modal fade" id="recoveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form id="recovery-form" >
                <div class="modal-header ">
                <h5 class="modal-title d-flex align-items-center">
                <i class="bi bi-shield-lock fs-3 me-2"></i> Set a new Password
                    </h5>
                </div>
                <div class="modal-body">
                
                  <div class="mb-4">
                    <label class="form-label">New Password</label>
                    <input type="password" name="pass" required class="form-control shadow-none">
                    <input type="hidden" name="email" >
                    <input type="hidden" name="token" >
                </div>
                <div class="mb-2 text-end">
                 <button type="button"  class="btn  shadow-none me-2"  data-bs-dismiss="modal">CANCEL </button> 
                 <button type="submit" class="btn btn-danger shadow-none">SUBMIT</button>
                </div>
                </div>
            </form>
            
            </div>
        </div>
  </div>



    <?php require('inc/footer.php');?>

<!-- modal for recovery  -->
    <?php 

    if (isset($_GET['account_recovery']))
    {
        $data = filteration($_GET);

        $t_date = date("Y-m-d");

        $query = select("SELECT * FROM `user_reg` WHERE `email`=? AND `token`=? AND `t_expired`=? LIMIT 1",
        [$data['email'],$data['token'],$t_date],'sss');

        if(mysqli_num_rows($query)==1)
        {
            echo <<<showModal
                <script>
                var myModal = document.getElementById('recoveryModal');

                 myModal.querySelector("input[name='email']").value = '$data[email]';
                 myModal.querySelector("input[name='token']").value = '$data[token]';

                var modal = bootstrap.Modal.getOrCreateInstance(myModal);
                modal.show();
               </script>
            showModal;
  
        }
        else{
           alert ("error", "Invalid or expired Link!");
        }

    }
    
    ?>


     <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
     <script>


            var swiper = new Swiper(".swiper-container", {
                spaceBetween: 30,
                effect: "fade",
                loop: true,
                autoplay:{
                    delay:3500,
                    disableOnInteraction: false,
                }
            });

            var swiper = new Swiper(".swipertest", {
                    effect: "coverflow",
                    grabCursor: true,
                    centeredSlides: true,
                    slidesPerView: "auto",
                    slidesPerView: "3",
                    loop: true,
                    coverflowEffect: {
                        rotate: 50,
                        stretch: 0,
                        depth: 100,
                        modifier: 1,
                        slideShadows:false,
                    },
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
                        slidesPerView: 2,
                    },
                    1024:{
                        slidesPerView: 3,
                    },
                    }
                });
     
     ///recover account

     let recovery_form = document.getElementById('recovery-form');

     recovery_form.addEventListener('submit', (e)=> {
            e.preventDefault();

            let data = new FormData();

            data.append('email', recovery_form.elements['email'].value);
            data.append('token', recovery_form.elements['token'].value);
            data.append('pass', recovery_form.elements['pass'].value);
            data.append('recover_user', '');

            var myModal = document.getElementById('recoveryModal');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/login_register.php", true);

            xhr.onload = function() {
            
                if (this.responseText == 'failed') {
                    alert('error',"Account reset  failed.");
                } 

                else {
                    alert('success',"Account reset Successful");
                    recovery_form.reset();
                
                }
            }

            xhr.send(data);
        });

     </script>

    </body>
</html>