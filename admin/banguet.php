<?php 
   require ('inc/essentials.php');
   require ('inc/db_config.php');
   adminLogin();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel Banguet</title>
    <?php require ('inc/link.php'); ?>
</head>


<body class="bg-ligth">
    
<?php require('inc/header.php');
?>

  <div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">

<!-- table for Banguet -->
            <div class="card border-0 shadow mb-4" >
              <div class="card-body">

                <div class="d-flex align-items-center justify-content-between mb-3">
                  <h5 class="card-title m-0" >BANGUET STYLE</h5>
                    <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#banguet-s">
                    <i class="bi bi-plus-square-fill"></i> Add
                    </button>
                </div>
                  
                <div class="table-responsive-md" style="height: 250px; overflow-y: scroll;">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col" width="40%">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="banguets-data" >      
                                </tbody>
                            </table>
                </div>

              </div>
            </div>


          </div>
        </div>
    </div>


          <!-- banguets modal -->

       <div class="modal fade" id="banguet-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <form id ="banguet_s_form" >
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Add banguet</h5>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                          <label class="form-label fe-bold">Name</label>
                          <input type="text" name="banguet_name"  class="form-control shadow-none" required>
                      </div>
                      <div class="mb-3">
                          <label class="form-label fw-bold">Image</label>
                          <input type="file" name="banguet_image" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none" required>
                      </div>
                      <div class="mb-3">
                          <label class="form-label">Description</label>
                          <textarea name="banguet_desc" class="form-control sahdow-none"  rows="3"></textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                      <button type="submit"  class="btn custom-bg text-white shadow-none">SUBMIT</button>
                    </div>
                  </div> 
              </form>
              
            </div>
      </div>
  

    <?php require ('inc/script.php'); ?>
     <script src="script/banguets.js"></script>

  

</body>
</html>