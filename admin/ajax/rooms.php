<?php 

    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();

//add rooms function  in data base

if (isset($_POST['add_room'])) {
  $features = filteration(json_decode($_POST['features']));
  $facilities = filteration(json_decode($_POST['facilities']));

  $frm_data = filteration($_POST);
  $flag = 0;

  $q1 = "INSERT INTO `rooms`(`name`, `area`, `price`, `quantity`, `description`, `type_id`) VALUES (?,?,?,?,?,?,?,?)";
  $values = [$frm_data['name'], $frm_data['area'], $frm_data['price'], $frm_data['quantity'], $frm_data['desc'], $frm_data['type_id']];

  if (insert($q1, $values, 'siiisi')) {
      $flag = 1;
  }

  $room_id = mysqli_insert_id($con);

  // Insert data to room facilities
  $q2 = "INSERT INTO `room_facilities`(`room_id`, `facilities_id`) VALUES (?, ?)";
  if ($stmt = mysqli_prepare($con, $q2)) {
      foreach ($facilities as $f) {
          mysqli_stmt_bind_param($stmt, 'ii', $room_id, $f);
          mysqli_stmt_execute($stmt);
      }
      mysqli_stmt_close($stmt);
  } else {
      $flag = 0;
      die('query cannot be prepared');
  }

  // Insert data to room features
  $q3 = "INSERT INTO `room_features`(`room_id`, `features_id`) VALUES (?, ?)";
  if ($stmt = mysqli_prepare($con, $q3)) {
      foreach ($features as $f) {
          mysqli_stmt_bind_param($stmt, 'ii', $room_id, $f);
          mysqli_stmt_execute($stmt);
      }
      mysqli_stmt_close($stmt);
  } else {
      $flag = 0;
      die('query cannot be prepared');
  }

  if ($flag) {
      echo 1;
  } else {
      echo 0;
  }
}

///get rooms details in data base and showin table  

if (isset($_POST['get_all_rooms'])) {
  $res = select("SELECT rooms.*, types_room.name AS type_name FROM `rooms` 
                 INNER JOIN `types_room` ON rooms.type_id = types_room.id 
                 WHERE rooms.removed=?", [0], 'i');
  $i = 1;
  $data = "";

  while ($row = mysqli_fetch_assoc($res)) {
      if ($row['status'] == 1) {
          $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none'>active</button>";
      } else {
          $status = "<button onclick='toggle_status($row[id],1)' class='btn btn-warning btn-sm shadow-none'>inactive</button>";
      }

      $data .= "
         <tr class='align-middle'>
          <td>$i</td>
          <td>$row[name]</td>
          <td>$row[type_name]</td>
          <td>$row[area] sq. ft.</td>
          <td>₱$row[price]</td>
          <td>$row[quantity]</td>
          <td>$status</td>
          <td>
              <button type='button' onclick='edit_details($row[id])' class='btn btn-primary shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit-room'>
                  <i class='bi bi-pencil-square'></i>
              </button>
              <button type='button' onclick=\"room_images($row[id],'$row[name]')\" class='btn btn-info shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#room-images'>
                  <i class='bi bi-images'></i>
              </button>
              <button type='button' onclick='remove_room($row[id])' class='btn btn-danger shadow-none btn-sm'>
                  <i class='bi bi-trash'></i>
              </button>
          </td>
         </tr>
      ";
      $i++;
  }

  echo $data;
}
///get data from data base room
  if (isset($_POST['get_room']))
  {
    $frm_data = filteration($_POST);

    $res1 = select("SELECT * FROM `rooms` WHERE `id`=?", [$frm_data['get_room']],'i');
    $res2 = select("SELECT * FROM `room_features` WHERE `room_id`=?", [$frm_data['get_room']],'i');
    $res3 = select("SELECT * FROM `room_facilities` WHERE `room_id`=?", [$frm_data['get_room']],'i');

    $roomdata = mysqli_fetch_assoc($res1);
    $features = [];
    $facilities = [];


    if (mysqli_num_rows($res2)>0)
    {
      while($row = mysqli_fetch_assoc($res2)){
       array_push($features,$row['features_id']);
      }

    }

    if (mysqli_num_rows($res3)>0)
    {
      while($row = mysqli_fetch_assoc($res3)){
       array_push($facilities,$row['facilities_id']);
      }

    }

    $data =["roomdata"=> $roomdata, "features"=>$features, "facilities"=>$facilities];

    $data= json_encode($data);

    echo $data;

  }

///edit rooms 

if (isset($_POST['edit_room'])) {
    $features = filteration(json_decode($_POST['features']));
    $facilities = filteration(json_decode($_POST['facilities']));
    $frm_data = filteration($_POST);
    $flag = 0;

    $q1 = "UPDATE `rooms` SET `name`=?, `type_id`=?, `area`=?, `price`=?, `quantity`=?, `description`=? WHERE `id`=?";
    $values = [
        $frm_data['name'],
        $frm_data['type_id'],
        $frm_data['area'],
        $frm_data['price'],
        $frm_data['quantity'],
        $frm_data['desc'],
        $frm_data['room_id']
    ];

    if (update($q1, $values, 'siiiisi')) {
        $flag = 1;
    }

    // Delete old features and facilities
    $del_features = p_delete("DELETE FROM `room_features` WHERE `room_id`=?", [$frm_data['room_id']], 'i');
    $del_facilities = p_delete("DELETE FROM `room_facilities` WHERE `room_id`=?", [$frm_data['room_id']], 'i');

    if (!($del_facilities && $del_features)) {
        $flag = 0;
    }

    // Insert new facilities
    $q2 = "INSERT INTO `room_facilities`(`room_id`, `facilities_id`) VALUES (?,?)";
    if ($stmt = mysqli_prepare($con, $q2)) {
        foreach ($facilities as $f) {
            mysqli_stmt_bind_param($stmt, 'ii', $frm_data['room_id'], $f);
            mysqli_stmt_execute($stmt);
        }
        $flag = 1;
        mysqli_stmt_close($stmt);
    } else {
        $flag = 0;
        die('query cannot be prepared for facilities');
    }

    // Insert new features
    $q3 = "INSERT INTO `room_features`(`room_id`, `features_id`) VALUES (?,?)";
    if ($stmt = mysqli_prepare($con, $q3)) {
        foreach ($features as $f) {
            mysqli_stmt_bind_param($stmt, 'ii', $frm_data['room_id'], $f);
            mysqli_stmt_execute($stmt);
        }
        $flag = 1;
        mysqli_stmt_close($stmt);
    } else {
        $flag = 0;
        die('query cannot be prepared for features');
    }

    echo $flag ? 1 : 0;
}




///update a status

  if (isset($_POST['toggle_status']))
  {
   $frm_data = filteration($_POST);

   $q = "UPDATE `rooms` SET `status`=? WHERE `id`=?";
   $v = [$frm_data['value'],$frm_data['toggle_status']];

    if (update($q,$v,'ii')){
        echo 1;
    }
    else{
        echo 0;
    }
  }


  //adding image of room 

  if(isset($_POST['add_image']))
    {
        $frm_data = filteration($_POST);

        $img_r = uploadImage($_FILES['image'],ROOMS_FOLDER);

        if($img_r == 'inv_img'){
            echo $img_r;
        }
        else if($img_r == 'inv_size'){
            echo $img_r;
        }
        else if ($img_r == 'upd_failed'){
            echo $img_r;
        }
        else{
           $q = "INSERT INTO `room_image`(`room_id`, `image`) VALUES (?,?)";
           $values = [$frm_data['room_id'],$img_r,];
           $res = insert($q,$values,'is');
           echo $res;
        }
    }

///geting image from database 

    if(isset($_POST['get_room_images']))
    {
        $frm_data = filteration($_POST);
        $res = select("SELECT * FROM `room_image` WHERE `room_id`=?",[$frm_data['get_room_images']],'i');

        
        $path =ROOMS_IMG_PATH;

        while ($row =mysqli_fetch_assoc($res))
        {
          if ($row['thumb']==1){
             $thumb_btn = "<i class='bi bi-check-lg text-light bg-success px-2 py-1 rounded fs-5' ></i>";
          }
          else{
            $thumb_btn = " <button onclick='thumb_image($row[sr_no],$row[room_id])' class='btn btn-secondary shadow-none' >
                <i class='bi bi-check-lg' > </i>
                </button>";
          }

          echo<<<data
            <tr class='align-middle' >
              <td><img src='$path$row[image]' class ='img-fluid' ></td>
              <td>$thumb_btn</td>
              <td>
                <button onclick='rem_image($row[sr_no],$row[room_id])' class='btn btn-danger shadow-none' >
                <i class='bi bi-trash' > </i>
                </button>
              </td>

            </tr>
          data;
        }


    }


    //delete image room
    if (isset($_POST['rem_image']))
    {
      $frm_data = filteration($_POST);
      $values = [$frm_data['image_id'],$frm_data['room_id']];

      $pre_q = "SELECT * FROM `room_image` WHERE `sr_no`=? AND `room_id`=?";
      $res = select($pre_q,$values,'ii');
      $img = mysqli_fetch_assoc($res);

      if (deleteImage($img['image'],ROOMS_FOLDER)){
         $q = "DELETE FROM `room_image` WHERE `sr_no` =? AND `room_id`=?";
         $res = p_delete($q,$values,'ii');
         echo $res;
      }
      else{
        echo 0;
      }


    }

//thumb image
    if (isset($_POST['thumb_image']))
    {
      $frm_data = filteration($_POST);
     
      $pre_q = "UPDATE `room_image` SET `thumb`=? WHERE `room_id`=?";
      $pre_v = [0,$frm_data['room_id']];
      $pre_res = update($pre_q,$pre_v,'ii');

      $q = "UPDATE `room_image` SET `thumb`=? WHERE `sr_no`=? AND `room_id`=?";
      $v = [1,$frm_data['image_id'],$frm_data['room_id']];
      $res = update($q,$v,'iii');

      echo $res;

    }
    
    //remove room
    if (isset($_POST['remove_room']))
    {
      $frm_data = filteration($_POST);
     
      $res1 = select("SELECT * FROM `room_image` WHERE `room_id`=?",[$frm_data['room_id']],'i');

      while($row= mysqli_fetch_assoc($res1)){
        deleteImage($row['image'],ROOMS_FOLDER);
      }
        $res2 = p_delete("DELETE FROM `room_image` WHERE `room_id`=?",[$frm_data['room_id']],'i');
        $res3 = p_delete("DELETE FROM `room_features` WHERE `room_id`=?",[$frm_data['room_id']],'i');
        $res4 = p_delete("DELETE FROM `room_facilities` WHERE `room_id`=?",[$frm_data['room_id']],'i');
        $res5 = update("UPDATE `rooms` SET `removed`=? WHERE `id`=?",[1,$frm_data['room_id']],'ii');

      if ($res2 || $res3 || $res4 || $res5){
        echo 1;
      }
      else{
        echo 0;
      }

    }
  



///add types_room
    
if(isset($_POST['add_types_room']))
{
    $frm_data = filteration($_POST);

    $img_r = uploadImageBT($_FILES['image'],TYPESROOM_FOLDER);

    if($img_r == 'inv_img'){
        echo $img_r;
    }
    else if($img_r == 'inv_size'){
        echo $img_r;
    }
    else if ($img_r == 'upd_failed'){
        echo $img_r;
    }
    else{
       $q = "INSERT INTO `types_room`(`image`,`name`, `description`) VALUES (?,?,?)";
       $values = [$img_r,$frm_data['name'],$frm_data['desc'],];
       $res = insert($q,$values,'sss');
       echo $res;
    }
}

///get types_room and display 
if(isset($_POST['get_types_room']))
{
 $res = selectAll('types_room');
 $i=1;
 $path = TYPESROOM_IMG_PATH;
 while ($row = mysqli_fetch_assoc($res))
 {
    echo <<< data
    <tr class= "align-middle" >
      <td>$i</td>
      <td><img src="$path$row[image]" width="60px"></td>
      <td>$row[name]</td>
      <td>$row[description]</td>
      <td>
        <button type="button" onclick="edit_types_room($row[id])" class="btn btn-primary btn-sm shadow-none" data-bs-toggle='modal' data-bs-target='#edit_types_room_modal'>
        <i class="bi bi-pencil-square"></i> Edit
       </button>

      <button type="button" onclick="rem_types_room($row[id])" class="btn btn-danger btn-sm shadow-none" >
         <i class="bi bi-trash3-fill"></i> Delete
     </button>
      </td>
    </tr>
    data;
    $i++;
 }
}
//remove types_room 

if (isset($_POST['rem_types_room']))
{
  $frm_data = filteration($_POST);
  $values = [$frm_data['rem_types_room']];

  $pre_q = "SELECT * FROM `types_room` WHERE `id`=?";
  $res = select($pre_q,$values,'i');
  $img = mysqli_fetch_assoc($res);

  if (deleteImage($img['image'],TYPESROOM_FOLDER)){
     $q = "DELETE FROM `types_room` WHERE `id` =?";
     $res = p_delete($q,$values,'i');
     echo $res;
  }
  else{
    echo 0;
  }


}



// Editing Types of Rooms data
if (isset($_POST['get_type_room'])) {
    $id = $_POST['get_type_room'];
    $query = "SELECT * FROM types_room WHERE id = $id LIMIT 1";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    
    echo json_encode($row);
    exit;
}


//submitte a edit data for types if room 

if (isset($_POST['edit_types_room'])) {
    $frm_data = filteration($_POST);
    
    $existing_image = mysqli_fetch_assoc(mysqli_query($con, "SELECT image FROM types_room WHERE id = ".$frm_data['id']))['image'];
    
    if ($_FILES['image']['name']) {
        $img_r = uploadImageBT($_FILES['image'], TYPESROOM_FOLDER);
    } else {
        $img_r = $existing_image; // Keep existing image if no new one is uploaded
    }

    if ($img_r == 'inv_img') {
        echo $img_r;
    } else if ($img_r == 'inv_size') {
        echo $img_r;
    } else if ($img_r == 'upd_failed') {
        echo $img_r;
    } else {
        $q = "UPDATE `types_room` SET `image`=?, `name`=?, `description`=? WHERE `id`=?";
        $values = [$img_r, $frm_data['name'], $frm_data['desc'], $frm_data['id']];
        $res = insert($q, $values, 'sssi'); // Ensure the types match the values
        echo $res;
    }
}





?>