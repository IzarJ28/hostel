 <?php 
   require ('inc/essentials.php');
   adminLogin();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard Settings</title>
    <?php require ('inc/link.php'); ?>
</head>


<body class="bg-ligth">
    
<?php require('inc/header.php');
?>

  <div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden"id="customAlert" class="custom-alert">
          <h3 class="mb-4" >SETTINGS</h3>

          <!--general setting-->

          <div class="card border-0 shadow mb-4" >
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="card-title m-0" >General Settings</h5>
                  <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#general-s">
                  <i class="bi bi-pencil-fill" ></i>Edit
                  </button>
              </div>
           
              <h6 class="card-subtitle mb-1 fw-bold">Site title</h6>
              <p class="card-text" id="site_title" ></p>
              <h6 class="card-subtitle mb-1 fw-bold">About U</h6>
              <p class="card-text"id="site_about"></p>
            </div>
          </div>

          <!-- Modal for Edit General -->
          <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <form id ="general_s_form" >
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">General Settings</h5>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                          <label class="form-label fe-bold">Site Title</label>
                          <input type="text" name="site_title" id="site_title_input" class="form-control shadow-none" required>
                      </div>
                      <div class="mb-3">
                          <label class="form-label fw-bold">About Us</label>
                          <textarea  name="site_about" id="site_about_input" class="form-control sahdow-none"  rows="6" required></textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" onclick="site_title.value = general_data.site_title, site_about.value = general_data.site_about" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                      <button type="submit"  class="btn custom-bg text-white shadow-none">SUBMIT</button>
                    </div>
                  </div>
              </form>
              
            </div>
          </div>

          <!-- shutdown -->

          <div class="card border-0 shadow mb-4 " >
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="card-title m-0" >Shutdown Website</h5>
                  <div class="form-check form-switch">
                    <form >
                     <input onchange="upd_shutdown(this.value)" class="form-check-input" type="checkbox" id ="shutdown-toggle">
                    </form>
                  </div>

              </div>
              <p class="card-text"id="site_about"></p>
              No customer will be allowed to  book in the hostel room ,when shutdown mode is turned on.
            </div>
          </div>

          <!-- Contact details -->

          <div class="card border-0 shadow mb-4" >
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="card-title m-0" >Contact  Settings</h5>
                  <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#contact-s">
                  <i class="bi bi-pencil-fill" ></i>Edit
                  </button>
              </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold">Address</h6>
                    <p class="card-text" id="address" ></p>
                    </div>
                    <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold">Google Map</h6>
                    <p class="card-text" id="gmap" ></p>
                    </div>
                    <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold">Phone Numbers</h6>
                    <p class="card-text mb-1">
                       <i class="bi bi-telephone-fill"></i> 
                       <span id="pn1" ></span>
                    </p>
                    <p class="card-text">
                       <i class="bi bi-telephone-fill"></i> 
                       <span id="pn2" ></span>
                    </p>
                    </div>
                    <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold">E-mail</h6>
                    <p class="card-text" id="email" ></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="mb-4">
                        <h6 class="card-subtitle mb-1 fw-bold">Social Links</h6>
                        <p class="card-text mb-1">
                        <i class="bi bi-facebook m-1"></i>
                          <span id="fb" ></span>
                        </p>
                      </div>
                      <div class="mb-4">
                        <h6 class="card-subtitle mb-1 fw-bold">iFrmaes</h6>
                        <iframe id="iframe" class="border p-2 w-100" loading ="lazy" ></iframe>
                      </div>

                  </div>
                </div>

            </div>
          </div>

          <!-- Modal for Edit Contact us -->

          <div class="modal fade" id="contact-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <form id ="contacts_s_form" >
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Contacts Settings</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid p-0">
                          <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                  <label class="form-label fe-bold">Address</label>
                                  <input type="text" name="address" id="address_input" class="form-control shadow-none" required>
                                </div>
                                <div class="mb-3">
                                  <label class="form-label fe-bold">Google Map Link</label>
                                  <input type="text" name="gmap" id="gmap_input" class="form-control shadow-none" required>
                                </div>
                                <div class="mb-3">
                                  <label class="form-label fe-bold">Phone Numbers (with country code)</label>
                                  <div class="input-group mb-3">
                                    <span class="input-group-text" >  <i class="bi bi-telephone-fill"></i> +</span>
                                    <input type="number" name="pn1" id="pn1_input" class="form-control shadow-none" required>
                                  </div>
                                  <div class="input-group mb-3">
                                    <span class="input-group-text" >  <i class="bi bi-telephone-fill"></i> +</span>
                                    <input type="number" name="pn2" id="pn2_input" class="form-control shadow-none">
                                  </div>
                                </div>
                                  
                            </div>
                            <div class="col-md-6">

                               <div class="mb-3">
                                    <label class="form-label fe-bold">Email</label>
                                    <input type="email" name="email" id="email_input" class="form-control shadow-none" required>
                                </div>
                                <div class="mb-3">
                                      <label class="form-label fe-bold">Social Links</label>
                                      <div class="input-group mb-3">
                                        <span class="input-group-text" ><i class="bi bi-facebook "></i> </span>
                                        <input type="text" name="fb" id="fb_input" class="form-control shadow-none" required>
                                      </div>
                                </div>
                                 <div class="mb-3">
                                    <label class="form-label fe-bold">Google Map Link</label>
                                    <input type="text" name="iframe" id="iframe_input" class="form-control shadow-none" required>
                                 </div>
                            </div>
                          </div>
                        </div>

                      </div>
                      <div class="modal-footer">
                      <button type="button" onclick="contacts_inp(contacts_data)" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                      <button type="submit"  class="btn custom-bg text-white shadow-none">SUBMIT</button>
                    </div>
                  </div>
                 </div>
                 
              </form>
              
            </div>

            <!--Management Team  setting-->

            <div class="card border-0 shadow mb-4" >
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="card-title m-0" >Management Team</h5>
                  <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#team-s">
                  <i class="bi bi-plus-square-fill"></i> Add
                  </button>
              </div>
                <div class="row" id="team-data" >
                </div>
            </div>
          </div>

          <!-- Modal for Team Management setting -->

          <div class="modal fade" id="team-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <form id ="team_s_form" >
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Add Team Member</h5>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                          <label class="form-label fe-bold">Name</label>
                          <input type="text" name="member_name" id="member_name_input" class="form-control shadow-none" required>
                      </div>
                      <div class="mb-3">
                          <label class="form-label fw-bold">Picture</label>
                          <input type="file" name="member_picture" id="member_picture_input" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none" required>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" onclick="member_name.value='',member_picture.value=''" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
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
<script src="script/script.js" ></script>

</body>
</html>