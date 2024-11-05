<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible " content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <?php require('inc/link.php');?>
 <title> <?php echo $settings_r['site_title'] ?> Banguet</title>
 
    <style>
    .pop:hover{
     border-top-color: var(--teal) !important;   
     transform: scale(1.03);
     transition: all 0.3s;
    }

    .no-highlight:focus {
    outline: none; /* Remove outline */
    box-shadow: none; /* Remove any box-shadow */
}

    </style>
 
</head>
<body class="bg-light">

   <?php require('inc/header.php');?>

   <div class="my-5 px-4">
      <h2 class="fw-bold h-font text-center">BANGUET STYLES</h2>
       <p class="text-center mt-3">
       A banquet style setup is specifically designed for functions rooms, featuring various table arrangements, typically in rectangular or round shapes, to accommodate guests comfortably. 
       This layout promotes interaction among attendees and allows for efficient service, making it ideal for a range of events, including weddings, corporate dinners, and other formal gatherings.
       </p>
   </div>

   <div class="container">
    <div class="row">
        <?php 
          
          $res = selectAll('banguet'); 
          $path = BANGUET_IMG_PATH;

          while ($row = mysqli_fetch_assoc($res)) {
            echo <<<data
                <div class="col-lg-3 col-md-6 mb-5 px-4">
                    <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                        <div class="text-center mb-3">
                            <img src="$path$row[image]" alt="$row[name]" class="img-fluid" style="max-width: 100%;">
                        </div>
                        <h5 class="text-center mb-3">$row[name]</h5>
                        <div class="text-center">
                            <button class="btn btn-link-dark p-0 no-highlight" data-bs-toggle="modal" data-bs-target="#detailsModal{$row['id']}">More Details</button>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="detailsModal{$row['id']}" tabindex="-1" aria-labelledby="detailsModalLabel{$row['id']}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailsModalLabel{$row['id']}">{$row['name']}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center mb-3">
                                    <img src="$path$row[image]" alt="$row[name]" class="img-fluid" style="max-width: 100%;">
                                </div>
                                <p>{$row['description']}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            data;
          }
        ?>
    </div>
</div>




    <?php require('inc/footer.php');?>

   

  
    </body>
</html>