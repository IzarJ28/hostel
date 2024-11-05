<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible " content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <?php require('inc/link.php');?>
 <title> <?php echo $settings_r['site_title'] ?> CONFIRM BOOKING</title>
 
 <style>
     /* Base styles */
     .header {
         display: flex;
         flex-direction: column;
         align-items: center;
         margin-bottom: 20px;
     }
     .header-logo, .hostel-image {
         width: 100px;
         margin: 50px;
     }
     .university-info {
         font-size: 16px;
         text-align: center;
         margin: 0 20px;
     }
     .title {
         font-size: 24px;
         font-weight: bold;
         text-align: center;
         margin: 10px 0;
         text-decoration: underline;
     }
     .form-title {
         font-size: 20px;
         margin: 20px 0;
         text-align: center;
     }
     .containerdiv {
         max-width: 800px;
         margin: auto;
         background: white;
         padding: 20px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
         margin-top: 10px;
     }
     .form-group {
         display: flex;
         flex-direction: column;
         margin-bottom: 15px;
     }
     .form-group label {
         font-weight: bold;
         padding-bottom: 5px;
     }
     .form-group input,
     .form-group textarea {
         width: 100%;
         padding: 5px;
         border: none;
         border-bottom: 2px solid #ccc;
         border-radius: 0;
         outline: none;
     }
     .form-row {
         display: flex;
         flex-direction: column;
     }
     table {
         width: 100%;
         border-collapse: collapse;
     }
     th, td {
         padding: 10px;
         text-align: left;
     }
      
     .center input,
     .center textarea{
         width: 100%;
         padding: 5px;
         border: none;
         border-bottom: 2px solid #ccc;
         border-radius: 0;
         outline: none;
     }
     .signature-pad {
         border: 1px solid black;
         width: 100%;
         height: 100px;
     }

     /* Responsive Design */
     @media (min-width: 768px) {
         .form-row {
             flex-direction: row;
             justify-content: space-between;
         }
         .form-row .form-group {
             width: 48%;
         }
         .header {
             flex-direction: row;
             justify-content: space-between;
         }
         .signature-pad {
             width: 300px;
         }
     }

     /* Mobile First */
     @media (max-width: 767px) {
         .form-group {
             width: 100%;
         }
         .form-row .form-group {
             width: 100%;
         }
     }


        .submit-btn-container {
            display: flex;
            justify-content: flex-end; /* Aligns the button to the right */
        }

/* Modal styles */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

       
 </style>


</head>

<body class="bg-light">

   <?php require('inc/header.php');?>

   
   <div class="containerdiv">
    <form id="guestForm">
        <div class="header">
            <img src="images/form/BSU.png" alt="University Logo" class="header-logo">
            <div class="university-info bg-white">
                <p>
                    Republic of the Philippines<br>
                    <strong>BATANGAS STATE UNIVERSITY</strong><br>
                    ARASOF-Nasugbu<br> 
                    Nasugbu, Batangas
                </p>
            </div>
            <img src="images/form/hostel.jpg" alt="Hostel Image" class="hostel-image">
        </div>

        <div class="title">
            <?php echo $settings_r['site_title'] ?>
        </div>

        <div class="form-title">
            Hostel Room Guest’s Registration Form
        </div>

        <div class="container">
            <div class="class-row">
                <div class="class-lg-12 bg-white shadow-none p-4 mb-1 rounded">
                    <h5 class="mb-4">GUEST INFORMATION </h5>
                    <div class="form-group">
                        <label for="principal-guest-name">Principal Guest Name:</label>
                        <input type="text" id="principal-guest-name" name="principal-guest-name" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="dob">Date of Birth:</label>
                            <input type="date" id="dob" name="dob" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail Address:</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" required>
                    </div>

                    <div class="form-group">
                        <label for="contact">Contact No.:</label>
                        <input type="number" id="contact" name="contact" required>
                    </div>
                </div>

                <div class="class-lg-12 bg-white shadow-none p-4 rounded">
                    <h5 class="mb-4">OTHER GUESTS </h5>
                    <table id="guestTable">
                        <tr>
                            <th class="center">No.</th>
                            <th>Name</th>
                            <th class="center">Age</th>
                            <th>Date of Birth</th>
                            <th class="center">Action</th>
                        </tr>
                        <tr>
                            <td class="center">1.</td>
                            <td class="center"><input type="text" name="guest1" style="width: 100%;"></td>
                            <td class="center"><input type="text" name="age1" style="width: 50px;"></td>
                            <td class="center"><input type="date" name="dob1" style="width: 100%;"></td>
                            <td class="center"><button type="button" onclick="deleteRow(this)">Delete</button></td>
                        </tr>
                    </table>

                    <button type="button" onclick="addGuestRow()">Add Guest</button>
                </div>

                <div class="class-lg-12 bg-white shadow-none p-4 mb-1 rounded">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="arrival-date">Arrival Date:</label>
                            <input type="date" id="arrival-date" name="arrival-date"required>
                        </div>
                        <div class="form-group">
                            <label for="departure-date">Departure Date:</label>
                            <input type="date" id="departure-date" name="departure-date"required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="checkin-time">Check-In Time:</label>
                            <input type="time" id="checkin-time" name="checkin-time"required>
                        </div>
                        <div class="form-group">
                            <label for="checkout-time">Check-Out Time:</label>
                            <input type="time" id="checkout-time" name="checkout-time"required>
                        </div>
                    </div>

                    <?php
                        // Get the room name from the query parameter if it exists
                        $room_name = isset($_GET['room_name']) ? $_GET['room_name'] : '';
                        ?>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="room-type">Room Type:</label>
                                <input type="text" id="room-type" name="room-type" value="<?php echo htmlspecialchars($room_name); ?>">
                            </div>
                        </div>

                    <!-- Special Remarks -->
                    <div class="form-group">
                        <label for="remarks">Remarks/Special Arrangements:</label>
                        <textarea id="remarks" name="remarks" rows="3"></textarea>
                    </div>
                </div>

                <div class="class-lg-12 bg-white shadow-none p-4 mb-1 rounded">
                            <h5 class="mb-4 ">Data Privacy and Protection</h5>
                        <p>
                        During your stay, information will be collected about you and your preferences
                        in order to provide you with the best possible service. The information will be
                            retained to facilitate future stays at BatStateU ARASOF Hostel. If there are any
                            questions regarding this data privacy, feel free to let us know at <a href="mailto:hostel.nasugbu@g.batstate-u.edu.ph">
                                hostel.nasugbu@g.batstate-u.edu.ph</a>. 
                        By signing, you are expressly giving your consent to the collection and storage
                            of your personal data as provided herein.

                        </p>
                </div> 
                
<!-- signiture -->
                    <div>
                        <label for="signature-draw">PRINCIPAL GUEST’S SIGNATURE:</label><br>
                        <canvas id="signature-pad" class="signature-pad"></canvas><br>
                        <button type="button" onclick="clearSignature('signature-pad', 'signature-input')">Clear Signature</button>
                        <input type="hidden" name="signature" id="signature-input">
                        <div class="upload-section mb-4">
                            <label for="signature-upload">Or upload your signature file:</label>
                            <input type="file" id="signature-upload" name="signature-file" accept="image/*">
                        </div>
                        <p id="error-message" style="display:none; color:red;">Please input a required information.</p>
                    </div>
               <div class="submit-btn-container">
               <button class="btn text-white shadow-none custom-bg" type="submit" onclick="return validateForm('signature-input', 'signature-upload', 'error-message')">Submit</button>
               </div>
            </div>
        </div>
    </form>
</div>             


    <?php require('inc/footer.php');?>






    

    <div id="guidelinesModal" class="modal"> 
    <form id="guidelinesForm" class="modal-content">
        <span class="close">&times;</span>
        
        <div class="header">
            <img src="images/form/BSU.png" alt="University Logo" class="header-logo">
            <div class="university-info bg-white">
                <p>
                    Republic of the Philippines<br>
                    <strong>BATANGAS STATE UNIVERSITY</strong><br>
                    ARASOF-Nasugbu<br>
                    Nasugbu, Batangas
                </p>
            </div>
            <img src="images/form/hostel.jpg" alt="Hostel Image" class="hostel-image">
        </div>

        <div class="title">
            <?php echo $settings_r['site_title'] ?>
        </div>

        <div class="form-title">
            HOSTEL ROOM GUIDELINES
        </div>

        <div class="bg-white shadow-none p-4 mb-1 rounded">
            <ol class="guidelines-list">
            <li>BatStateU Hostel is a non-smoking area</li>
                    <li>Standard Check-in time at 2:00 pm and 12:00 noon check out time.</li>
                    <li>The hostel is located at BatStateU ARASOF - Nasugbu Campus. Maintaining good relationships with faculty and students must be observed. 
                        Be generally mindful by their presence as they move around the building.</li>
                    <li>Toned-down sounds between 7 AM until 6 PM are observed in consideration for the faculty and students during class hours.</li>
                    <li>No Curfew administered for all the guests, however perceive not to disturb others upon returning to the Hostel late at night</li>
                    <li>Hostel Laundry Service for Php 100.00 per kilogram, inclusive of powder detergent w/ color protection and fabric softener. Housekeeping to assist with laundry provided with laundry bag</li>
                    <li>Trash Bins are placed around the Hostel. Proper throwing of trash helps us maintain the cleanliness of the facilities for the guests as well as for the faculty and students</li>
                    <li>Turning off the lights and air-conditioning as well as the faucet before leaving the Hostel room will help us conserve energy and water</li>
                    <li>BatStateU Hostel is not liable for any lost or damage of guest’s personal belongings.</li>
                    <li>Room Keys can be deposited at the reception. Any lost key will be charged accordingly.</li>
                    <li>Incidental charges will apply for any loss or damages at the Hostel property during the guest’s stay.
                         Settlement must be done before check-out/departure and must be settled through cash.</li>
                    <li>The management reserves the right to refuse entry/stay to individuals violating Hotel policies and guidelines.</li>
                    <li>Hostel Housekeeping staff is authorized to enter your room with or without guests inside for a housekeeping operation</li>
            </ol>
            
            <div class="prohibited-title">PROHIBITED ACTS</div>
            <ul class="prohibited-list">
                <!-- Prohibited acts list -->
                <li>Uncooked foods and cooking inside the Hostel room of prohibited.</li>
                    <li>Deadly weapons and illegal drugs are STRICTLY PROHIBITED inside the hostel</li>
                    <li>Drinking inside the Hostel room is not allowed. Hostel Bar on the ground floor can be used for any alcoholic beverage consumption</li>
                    <li>Pets are not allowed inside the property.</li>
                    <li>Only registered guests are allowed to stay in the Hostel room</li>
            </ul>
            
            <div class="contact-info">
            <p>For further clarification and queries, please contact us at 09756164034 or email us at <a href="mailto:hostel_nasubu@batstate-u.edu.ph">hostel_nasubu@batstate-u.edu.ph</a>.</p>
            <p>Thank you. We look forward to welcoming you to the Hostel.</p>
            </div>
            
            <p>
                <input type="checkbox" id="acknowledgementCheckbox" required>
                I have read and understand all the guidelines and prohibited acts at BatStateU ARASOF Hostel during my stay.
                I am acknowledging my liabilities as stated in the guidelines above.
            </p>
        </div>

        <div class="submit-btn-container">
            <button type="button" class="btn text-secondary shadow-none" onclick="cancelAgreement()">CANCEL</button>
            <button class="btn text-white shadow-none custom-bg" type="button" onclick="submitAgreement()">I Agree</button>
        </div>
    </form>
</div>





<!--     

    <div id="guidelinesModal" class="modal">
    <form id="guidelinesForm" class="modal-content">
        <span class="close">&times;</span>
        
        <div class="header">
            <img src="images/form/BSU.png" alt="University Logo" class="header-logo">
            <div class="university-info bg-white">
                <p>
                    Republic of the Philippines<br>
                    <strong>BATANGAS STATE UNIVERSITY</strong><br>
                    ARASOF-Nasugbu<br>
                    Nasugbu, Batangas
                </p>
            </div>
            <img src="images/form/hostel.jpg" alt="Hostel Image" class="hostel-image">
        </div>

        <div class="title">
            <?php echo $settings_r['site_title'] ?>
        </div>

        <div class="form-title">
            HOSTEL ROOM GUIDELINES
        </div>

        <div class="bg-white shadow-none p-4 mb-1 rounded">
            <ol class="guidelines-list">
          
            </ol>
            
            <div class="prohibited-title">PROHIBITED ACTS</div>
            <ul class="prohibited-list">
           
            </ul>
            
            <div class="contact-info">
               
            </div>
            
            <p>
            <input type="checkbox" id="acknowledgementCheckbox" required>
                    I have read and understand all the guidelines and prohibited acts at BatStateU ARASOF Hostel during my stay.
                    I am acknowledging my liabilities as stated in the guidelines above.
            </p>
        </div>

        <div class="submit-btn-container">
            <button type="button" class="btn text-secondary shadow-none" onclick="cancelAgreement()">CANCEL</button>
            <button class="btn text-white shadow-none custom-bg" type="button" onclick="submitAgreement()">I Agree</button>
        </div>
    </form>
</div>

 -->


   



<script src="script/guest_room.js"></script>



  
    </body>
</html>