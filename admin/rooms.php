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
    <title>Admin Panel Rooms</title>
    <?php require ('inc/link.php'); ?>
</head>


<body class="bg-ligth">
    
<?php require('inc/header.php');
?>

<div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <h3 class="mb-4" >TYPES OF ROOMS</h3>

<!-- table for types of rooms -->
            <div class="card border-0 shadow mb-4" >
              <div class="card-body">

                <div class="d-flex align-items-center justify-content-between mb-3">
                  <h5 class="card-title m-0" >Types Of Rooms</h5>
                    <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#types_room-s">
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
                                <tbody id="types_rooms-data" >      
                                </tbody>
                            </table>
                </div>

              </div>
            </div>


          </div>
        </div>
    </div>

    <!-- rooms table -->

  <div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
          <h3 class="mb-4" >ROOMS</h3>


            <div class="card border-0 shadow mb-4" >
              <div class="card-body">

                <div class="text-end  mb-4">
                    <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-room">
                    <i class="bi bi-plus-square-fill"></i> Add
                    </button>
                </div>

                <!-- table for rooms -->
                  
                <div class="table-responsive-lg" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border text-center">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Room Type</th>
                                        <th scope="col">Area</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="room-data" >      
                                </tbody>
                            </table>
                </div>

              </div>
            </div>

          </div>
        </div>
    </div>


<!-- Types of rooms modal -->

<div class="modal fade" id="types_room-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <form id ="types_room_s_form" >
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Add Types of Rooms</h5>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                          <label class="form-label fe-bold">Name</label>
                          <input type="text" name="types_room_name"  class="form-control shadow-none" required>
                      </div>
                      <div class="mb-3">
                          <label class="form-label fw-bold">Image</label>
                          <input type="file" name="types_room_image" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none" required>
                      </div>
                      <div class="mb-3">
                          <label class="form-label">Description</label>
                          <textarea name="types_room_desc" class="form-control sahdow-none"  rows="3" required></textarea>
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

<!-- Edit Types of Rooms Modal -->
<div class="modal fade" id="edit_types_room_modal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="edit_types_room_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Types of Rooms</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <input type="text" name="types_room_name" class="form-control shadow-none" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Current Image</label>
                        <span id="current_image_name" style="display: none;"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Image</label>
                        <input type="file" name="types_room_image" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="types_room_desc" class="form-control shadow-none" rows="3" required></textarea>
                    </div>
                    <input type="hidden" name="types_room_id"> <!-- This will hold the ID for submission -->
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                    <button type="submit" class="btn custom-bg text-white shadow-none">SAVE</button>
                </div>
            </div>
        </form>
    </div>
</div>




    <!-- Add Rooms MOdal -->

    <div class="modal fade" id="add-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <form id ="add_room_form" autocomplete="off" >
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Add Rooms</h5>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fe-bold">Name</label>
                            <input type="text" name="name"  class="form-control shadow-none" required>
                        </div>
                          <div class="col-md-6 mb-3">
                            <label class="form-label fe-bold">Room Type</label>
                            <select name="type_id" class="form-control shadow-none" required>
                                <option value="">Select Room Type</option>
                                <?php
                                $res = selectAll('types_room');
                                while ($opt = mysqli_fetch_assoc($res)) {
                                    echo "<option value='$opt[id]'>$opt[name]</option>";
                                }
                                ?>
                            </select>
                         </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fe-bold">Area</label>
                            <input type="number" min="1" name="area"  class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fe-bold">Price</label>
                            <input type="number" min="1" name="price"  class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fe-bold">Quantity</label>
                            <input type="number" min="1" name="quantity"  class="form-control shadow-none" required>
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label class="form-label fe-bold">Features</label>
                            <div class="row">
                              <?php 
                              $res = selectAll('features');
                              while($opt = mysqli_fetch_assoc($res)){
                              echo"
                                  <div class='col-md-3 mb-1'>
                                    <label>
                                      <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'>
                                      $opt[name]
                                    </label>
                                  
                                  </div>
                                ";
                              }
                              ?>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fe-bold">Facilities</label>
                                <div class="row">
                                  <?php 
                                  $res = selectAll('facilities');
                                  while($opt = mysqli_fetch_assoc($res)){
                                  echo"
                                      <div class='col-md-3 mb-1'>
                                        <label>
                                          <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'>
                                          $opt[name]
                                        </label>
                                      
                                      </div>
                                    ";
                                  }
                                  ?>
                                </div>
                        </div>
                        <div class="col-12 mb-3">
                          <label class="form-label fe-bold">Description</label>
                          <textarea name="desc" rows="4" class="form-control shadow-none" required></textarea>
                        </div>
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

<!-- edit room modal  -->

          <div class="modal fade" id="edit-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <form id ="edit_room_form" autocomplete="off" >
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit Rooms</h5>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fe-bold">Name</label>
                            <input type="text" name="name"  class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fe-bold">Room Type</label>
                            <select name="type_id" class="form-control shadow-none" required>
                                <option value="">Select Room Type</option>
                                <?php
                                $res = selectAll('types_room');
                                while ($opt = mysqli_fetch_assoc($res)) {
                                    echo "<option value='$opt[id]'>$opt[name]</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fe-bold">Area</label>
                            <input type="number" min="1" name="area"  class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fe-bold">Price</label>
                            <input type="number" min="1" name="price"  class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fe-bold">Quantity</label>
                            <input type="number" min="1" name="quantity"  class="form-control shadow-none" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fe-bold">Features</label>
                            <div class="row">
                              <?php 
                              $res = selectAll('features');
                              while($opt = mysqli_fetch_assoc($res)){
                              echo"
                                  <div class='col-md-3 mb-1'>
                                    <label>
                                      <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'>
                                      $opt[name]
                                    </label>
                                  
                                  </div>
                                ";
                              }
                              ?>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fe-bold">Facilities</label>
                                <div class="row">
                                  <?php 
                                  $res = selectAll('facilities');
                                  while($opt = mysqli_fetch_assoc($res)){
                                  echo"
                                      <div class='col-md-3 mb-1'>
                                        <label>
                                          <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'>
                                          $opt[name]
                                        </label>
                                      
                                      </div>
                                    ";
                                  }
                                  ?>
                                </div>
                        </div>
                        <div class="col-12 mb-3">
                          <label class="form-label fe-bold">Description</label>
                          <textarea name="desc" rows="4" class="form-control shadow-none" required></textarea>
                        </div>
                        <input type="hidden" name="room_id">
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


    <!-- Room image Modal -->
        <div class="modal fade" id="room-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" >Room Name</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div id="image-alert">

                </div>
                <div class="border-bottom border-3 pb-3 mb-3" >
                  <form id="add_image_form" >
                    <label class="form-label fw-bold">Add Image</label>
                    <input type="file" name="image" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none mb-3" required>
                      <button class="btn custom-bg text-white shadow-none">ADD</button>
                      <input type="hidden" name="room_id">
                   </form>
                </div>
                  <div class="table-responsive-lg" style="height: 350px; overflow-y: scroll;">
                              <table class="table table-hover border text-center">
                                  <thead>
                                      <tr class="bg-dark text-light sticky-top">
                                          <th scope="col" width ="60%" >Image</th>
                                          <th scope="col">Thumb</th>
                                          <th scope="col">Delete</th>
                                      </tr>
                                  </thead>
                                  <tbody id="room-image-data" >      
                                  </tbody>
                              </table>
                  </div>
              </div>
            </div>
          </div>
        </div>



  

    <?php require ('inc/script.php'); ?>

    <script src="script/room.js"></script>


  

</body>
</html>