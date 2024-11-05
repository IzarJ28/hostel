<?php


require('../inc/link.php');


$type_id = isset($_POST['id']) ? $_POST['id'] : null;
$offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
$displayedIds = isset($_POST['displayedIds']) ? json_decode($_POST['displayedIds'], true) : [];
$limit = 3;

// Prepare placeholders for excluded room IDs in SQL query
$excludedPlaceholders = implode(',', array_fill(0, count($displayedIds), '?'));
$exclusionQuery = count($displayedIds) ? "AND `id` NOT IN ($excludedPlaceholders)" : '';

$query = $type_id ?
    "SELECT * FROM `rooms` WHERE `type_id`=? AND `status`=? AND `removed`=? $exclusionQuery ORDER BY `id` DESC LIMIT ? OFFSET ?" :
    "SELECT * FROM `rooms` WHERE `status`=? AND `removed`=? $exclusionQuery ORDER BY `id` DESC LIMIT ? OFFSET ?";

    //to not double room 
// Add room IDs to params for exclusion/
$params = $type_id ? array_merge([$type_id, 1, 0], $displayedIds, [$limit, $offset]) : array_merge([1, 0], $displayedIds, [$limit, $offset]);
$types = $type_id ? str_repeat('i', 3 + count($displayedIds)) . 'ii' : str_repeat('i', 2 + count($displayedIds)) . 'ii';

$room_res = select($query, $params, $types);

$newRoomIds = [];


while ($room_data = mysqli_fetch_assoc($room_res)) {
    $newRoomIds[] = $room_data['id'];
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
        $book_btn ="<button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-sm w-100 text-white custom-bg shadow-none mb-2'>Book Now</button>";
    }

    echo <<<data
        <div class="card mb-4 border-0 shadow">
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



///for hiding a button see more rooms if no rooms
$total_query = $type_id ?
    "SELECT COUNT(*) as total FROM `rooms` WHERE `type_id`=? AND `status`=? AND `removed`=?" :
    "SELECT COUNT(*) as total FROM `rooms` WHERE `status`=? AND `removed`=?";
$total_params = $type_id ? [$type_id, 1, 0] : [1, 0];
$total_res = select($total_query, $total_params, $type_id ? 'iii' : 'ii');
$total_row = mysqli_fetch_assoc($total_res);
$total_rooms = $total_row['total'];

// Check if there are more rooms beyond the current offset
$remaining_rooms = $total_rooms - ($offset + $limit);

if ($remaining_rooms > 0) {
    echo '<!-- more -->'; // Indicate more rooms are available
} else {
    echo ''; // Indicate no more rooms are available
}
       

   
?>