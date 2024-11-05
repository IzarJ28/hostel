<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible " content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <?php require('inc/link.php');?>
 <title> <?php echo $settings_r['site_title'] ?> ROOMS</title>
 <style>
   #roomContainer {
            height: 600px; /* Set a fixed height for the container */
            overflow-y: auto; /* Enable vertical scrollbar */
            padding-right: 10px; /* Optional: add some space to accommodate the scrollbar */
            padding-bottom: 20px; /* Ensure space at the bottom for smoother scrolling */
        }

 </style>
</head>
<body class="bg-light">

   <?php require('inc/header.php');?>

   <div class="my-5 px-4">
      <h2 class="fw-bold h-font text-center">OUR ROOMS</h2>
   </div>

        <!--room form check avail-->

   <div class="container-fluid">
        <div class="row">
           <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 ps-4">
            <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
             <div class="container-fluid flex-lg-column align-items-strech ">
                <h4 class="mt-2">FILTER</h4>
                <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse flex-column align-items-strech mt-2" id="filterDropdown">
                  <div class="border bg-light p-3 rounded mb-3">
                    <h5 class="mb-3" style="font-size: 18px;">CHECK AVAILABILITY</h5>
                    <label class="form-label" >Check-in</label>
                    <input type="date" class="form-control shadow-none mb-3">
                    <label class="form-label" >Check-out</label>
                    <input type="date" class="form-control shadow-none">
                  </div>
                  <div class="border bg-light p-3 rounded mb-3">
                    <h5 class="mb-3" style="font-size: 18px;">FACILITIES</h5>
                    <div class="mb-2">
                    <input type="checkbox" id="f1" class="form-check-input shadow-none me-1">
                    <label class="form-check-label" for="f1" >Facilities one</label>
                    </div>
                    <div class="mb-2">
                    <input type="checkbox" id="f2" class="form-check-input shadow-none me-1">
                    <label class="form-check-label" for="f2" >Facilities two</label>
                    </div>
                    <div class="mb-2">
                    <input type="checkbox" id="f3" class="form-check-input shadow-none me-1">
                    <label class="form-check-label" for="f3" >Facilities three </label>
                    </div>
                    
                  </div>
                  <div class="border bg-light p-3 rounded mb-3">
                    <h5 class="mb-3" style="font-size: 18px;">GUEST</h5>
                    <div class="d-flex">
                    <div class="me-3">
                        <label class="form-label" >Adults</label>
                        <input type="number" class="form-control shadow-none mb-3">
                        </div>
                        <div>
                        <label class="form-label" >Children</label>
                        <input type="number" class="form-control shadow-none mb-3">
                        </div>
                    </div>
                  </div>
                </div>
             </div>
            </nav>
           </div>

        
            <div class="col-lg-9 col-md-12 px-4 shadow-none">
        <!-- script for showing a data in card about roomn  -->
                <div id="roomContainer">
                        <?php 
                        $type_id = isset($_GET['id']) ? $_GET['id'] : null;
                        $room_limit = 3;
                        
                        // Query to fetch initial rooms
                        $query = $type_id ?
                            "SELECT * FROM `rooms` WHERE `type_id`=? AND `status`=? AND `removed`=? ORDER BY `id` DESC LIMIT ?" :
                            "SELECT * FROM `rooms` WHERE `status`=? AND `removed`=? ORDER BY `id` DESC LIMIT ?";
                        $params = $type_id ? [$type_id, 1, 0, $room_limit] : [1, 0, $room_limit];
                        $types = $type_id ? 'iiii' : 'iii';
                        
                        $room_res = select($query, $params, $types);
                        $room_count = mysqli_num_rows($room_res);

                        //condtion for rooms if available 

                    if ($room_count === 0) {
                            echo '
                                <div class="row g-0 p-3 align-items-center text-center mt-5" style="background-color: #f8d7da; border-radius: 0.5rem; padding: 20px;">
                                    <i class="bi bi-emoji-frown" style="font-size: 3rem; color: #dc3545;"></i>
                                    <h2 class="mt-3">No Rooms Available</h2>
                                </div>
                                ';
                    } else 
                    
                    {
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
                            if (!$settings_r['shutdown']) {
                                $login = 0;
                                if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                                    $login = 1;
                                }
                                $book_btn = "<button onclick='checkLoginToBook($login, $room_data[id], $room_data[type_id], \"$room_data[name]\")' class='btn btn-sm w-100 text-white custom-bg shadow-none mb-2'>Book Now</button>";
                            }
                            echo <<<data
                                <div class="card mb-4 border-0 shadow-none">
                                    <div class="row g-0 p-3 align-items-center">
                                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                                            <img src="$room_thumb" class="img-fluid rounded">
                                        </div>
                                        <div class="col-md-5 px-lg-3 px-md-3 px-0">
                                            <h5 class="mb-3">$room_data[name]</h5>
                                            <div class="features mb-3">
                                                <h6 class="mb-1">Features</h6>
                                                $features_data
                                            </div>
                                            <div class="facilities mb-3">
                                                <h6 class="mb-1">Facilities</h6>
                                                $facilities_data
                                            </div>
                                            <div class="guest">
                                                <h6 class="mb-1">Guest</h6>
                                                <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>$room_data[quantity] person</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                                            $price_display
                                            $book_btn
                                            <a href="room_details.php?id=$room_data[id]" class="btn btn-sm w-100 btn-outline-dark shadow-none">More Details</a>
                                        </div>
                                    </div>
                                </div>
                            data;
                        }
                    }    
                        ?>
                
                </div>

                
                 <!-- Fetch the total number of rooms for checking if more rooms are available -->
                <?php
                        $total_query = $type_id ? 
                            "SELECT COUNT(*) as total FROM `rooms` WHERE `type_id`=? AND `status`=? AND `removed`=?" : 
                            "SELECT COUNT(*) as total FROM `rooms` WHERE `status`=? AND `removed`=?";
                        $total_params = $type_id ? [$type_id, 1, 0] : [1, 0];
                        $total_res = select($total_query, $total_params, $type_id ? 'iii' : 'ii');
                        $total_row = mysqli_fetch_assoc($total_res);
                        $total_rooms = $total_row['total'];

                        if ($total_rooms > $room_limit) {
                            echo '<div class="d-flex justify-content-center mt-4">
                                    <button id="seeMoreBtn" class="btn-outline-dark shadow-none">See More Rooms</button>
                                </div>';
                        }
                ?>

                

            </div>
       </div>
 </div>

 

    <?php require('inc/footer.php');?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const seeMoreBtn = document.getElementById('seeMoreBtn');
            let offset = 3;
            let displayedRoomIds = [];

            if (seeMoreBtn) {
                seeMoreBtn.addEventListener('click', function() {
                    const typeId = '<?php echo $type_id; ?>';
                    const xhr = new XMLHttpRequest();
                    xhr.open("POST", "ajax/load_rooms.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            const roomContainer = document.getElementById('roomContainer');
                            const response = xhr.responseText.trim();

                            if (roomContainer) {
                                if (response === '') {
                                    seeMoreBtn.style.display = 'none';
                                } else {
                                    roomContainer.innerHTML += response.replace('<!-- more -->', '');

                                    const newRoomIds = JSON.parse(xhr.getResponseHeader('Displayed-Room-Ids'));
                                    displayedRoomIds = displayedRoomIds.concat(newRoomIds);
                                    offset += 2;

                                    if (!response.includes('<!-- more -->')) {
                                        seeMoreBtn.style.display = 'none';
                                    }
                                }
                            }
                        }
                    };

                    xhr.send(`id=${typeId}&offset=${offset}&displayedIds=${JSON.stringify(displayedRoomIds)}`);
                });
            }
        });
    </script>


  
    </body>
</html>