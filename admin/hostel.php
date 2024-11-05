<?php 
   require ('inc/essentials.php');
   adminLogin();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel Hostel</title>
    <?php require ('inc/link.php'); ?>
</head>


<body class="bg-ligth">
    
<?php require('inc/header.php');
?>

  <div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
          <h3 class="mb-4" >Hostel</h3>


            <!--hostel
             section-->

            <div class="card border-0 shadow mb-4" >
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="card-title m-0" >Images</h5>
                  <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#hostel-s">
                  <i class="bi bi-plus-square-fill"></i> Add
                  </button>
              </div>
                <div class="row" id="hostel-data" >
                </div>
            </div>
          </div>

          <!-- Modal for hostel -->




          <div class="modal fade" id="hostel-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <form id ="hostel_s_form" >
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Add Image</h5>
                    </div>
                    <div class="modal-body">
                 
                      <div class="mb-3">
                          <label class="form-label fw-bold">Picture</label>
                          <input type="file" name="hostel_picture" id="hostel_picture_input" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none" required>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" onclick="hostel_picture.value=''" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                      <button type="submit"  class="btn custom-bg text-white shadow-none">SUBMIT</button>
                    </div>
                  </div> 
              </form>
              
            </div>
          </div>



          </div>
        </div>
    </div>
  

    <?php require ('inc/script.php'); ?>

<script src="script/hostel.js" ></script>

</body>
</html>