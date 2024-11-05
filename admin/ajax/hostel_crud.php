<?php 

    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();



///added new image in hostel

    if(isset($_POST['add_image']))
    {
   
        $img_r = uploadImage($_FILES['picture'],HOSTEL_FOLDER);

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
           $q = "INSERT INTO `hostel`( `image`) VALUES (?)";
           $values = [$img_r,];
           $res = insert($q,$values,'s');
           echo $res;
        }
    }

/// get name and picture member 
    if(isset($_POST['get_hostel']))
    {
     $res = selectAll('hostel');

     while ($row = mysqli_fetch_assoc($res))
     {
        $path = HOSTEL_IMG_PATH;
        echo <<< data
         <div class="col-md-2 mb-3">
             <div class="card bg-dark text-white">
                <img src="$path$row[image]" class="card-img">
                 <div class="card-img-overlay text-end">
                    <button type="button" onclick="rem_image($row[sr_no])" class="btn btn-danger btn-sm shadow-none" >
                     <i class="bi bi-trash3-fill"></i> Delete
                    </button>
    
                  </div>
                 </div>
          </div>
        data;
     }
    }
//delete image hostel
    if (isset($_POST['rem_image']))
    {
      $frm_data = filteration($_POST);
      $values = [$frm_data['rem_image']];

      $pre_q = "SELECT * FROM `hostel` WHERE `sr_no`=?";
      $res = select($pre_q,$values,'i');
      $img = mysqli_fetch_assoc($res);

      if (deleteImage($img['image'],HOSTEL_FOLDER)){
         $q = "DELETE FROM `hostel` WHERE `sr_no` =?";
         $res = p_delete($q,$values,'i');
         echo $res;
      }
      else{
        echo 0;
      }


    }




?>