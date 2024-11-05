<?php 
   require ('inc/essentials.php');
   require ('inc/db_config.php');
   adminLogin();

  if (isset($_GET['seen']))
  {
    $frm_data = filteration($_GET);

    if ($frm_data['seen']=='all'){
      $q = "UPDATE `user_message` SET `seen`=?";
      $values = [1];
      if(update($q,$values,'i')){
        alert('success','Mark all as read');
      }
      else{
        alert ('error','Operation failed');
      }
    }
    else{
      $q = "UPDATE `user_message` SET `seen`=? WHERE `sr_no`=?";
      $values = [1,$frm_data['seen']];
      if(update($q,$values,'ii')){
        alert('success','Mark as read');
      }
      else{
        alert ('error','Operation failed');
      }
    }
  }

  if (isset($_GET['del']))
  {
    $frm_data = filteration($_GET);

    if ($frm_data['del']=='all'){
      $q = "DELETE FROM `user_message` ";
      if(mysqli_query($con,$q)){
        alert('success','All Message Deleted');
      }
      else{
        alert ('error','Operation failed');
      }
    }
    else{
      $q = "DELETE FROM `user_message` WHERE `sr_no`=?";
      $values = [$frm_data['del']];
      if(p_delete($q,$values,'i')){
        alert('success','Message Deleted');
      }
      else{
        alert ('error','Operation failed');
      }
    }
  }

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel User Message</title>
    <?php require ('inc/link.php'); ?>
</head>


<body class="bg-ligth">
    
<?php require('inc/header.php');
?>

  <div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
          <h3 class="mb-4" >USER MESSAGE</h3>


            <div class="card border-0 shadow mb-4" >
              <div class="card-body">

              <div class="text-end mb-4" >
                <a href="?seen=all" class="btn btn-dark rounded-pill shadow-none btn-sm" >
                <i class="bi bi-check2-all"></i> Mark All Read</a>
                <a href="?del=all" class="btn btn-danger rounded-pill shadow-none btn-sm" >
                <i class="bi bi-trash3-fill"></i> Delete All</a>

              </div>
                
                    <div class="table-responsive-md" style="height: 350px; overflow-y: scroll;">
                          <table class="table table-hover table-bordered">
                              <thead class="sticky-top">
                                  <tr class="bg-dark text-light">
                                      <th scope="col">#</th>
                                      <th scope="col">Name</th>
                                      <th scope="col">Email</th>
                                      <th scope="col" width="25%">Subject</th>
                                      <th scope="col" width="28%">Message</th>
                                      <th scope="col">Date</th>
                                      <th scope="col">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                  $q = "SELECT * FROM `user_message` ORDER BY `sr_no` DESC";
                                  $data = mysqli_query($con, $q);
                                  $i = 1;

                                  while ($row = mysqli_fetch_assoc($data)) {
                                      $seen = '';
                                      if ($row['seen'] != 1) {
                                          $seen = "<a href ='?seen=$row[sr_no]' class='btn btn-sm rounded-pill btn-primary'>Mark as Read</a> <br>";
                                      }
                                      $seen .= "<a href ='?del=$row[sr_no]' class='btn btn-sm rounded-pill btn-danger mt-2'>Delete</a>";

                                      echo <<<message
                                      <tr>
                                          <td>$i</td>
                                          <td>$row[name]</td>
                                          <td>$row[email]</td>
                                          <td>$row[subject]</td>
                                          <td>$row[message]</td>
                                          <td>$row[date]</td>
                                          <td>$seen</td>
                                      </tr>
                                      message;
                                      $i++;
                                  }
                                  ?>
                              </tbody>
                          </table>
                  </div>

              </div>
            </div>




          </div>
        </div>
    </div>
  

    <?php require ('inc/script.php'); ?>


</body>
</html>