<?php 

    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();




///add banguet
    
    if(isset($_POST['add_banguet']))
    {
        $frm_data = filteration($_POST);

        $img_r = uploadImageBT($_FILES['image'],BANGUET_FOLDER);

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
           $q = "INSERT INTO `banguet`(`image`,`name`, `description`) VALUES (?,?,?)";
           $values = [$img_r,$frm_data['name'],$frm_data['desc'],];
           $res = insert($q,$values,'sss');
           echo $res;
        }
    }

///get banguet and display 
   if(isset($_POST['get_banguet']))
    {
     $res = selectAll('banguet');
     $i=1;
     $path = BANGUET_IMG_PATH;
     while ($row = mysqli_fetch_assoc($res))
     {
        echo <<< data
        <tr class= "align-middle" >
          <td>$i</td>
          <td><img src="$path$row[image]" width="60px"></td>
          <td>$row[name]</td>
          <td>$row[description]</td>
          <td>
          <button type="button" onclick="rem_banguet($row[id])" class="btn btn-danger btn-sm shadow-none" >
             <i class="bi bi-trash3-fill"></i> Delete
         </button>
          </td>
        </tr>
        data;
        $i++;
     }
    }
  //remove banguet 
 
    if (isset($_POST['rem_banguet']))
    {
      $frm_data = filteration($_POST);
      $values = [$frm_data['rem_banguet']];

      $pre_q = "SELECT * FROM `banguet` WHERE `id`=?";
      $res = select($pre_q,$values,'i');
      $img = mysqli_fetch_assoc($res);

      if (deleteImage($img['image'],BANGUET_FOLDER)){
         $q = "DELETE FROM `banguet` WHERE `id` =?";
         $res = p_delete($q,$values,'i');
         echo $res;
      }
      else{
        echo 0;
      }


    }
?>