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

                    <div class="form-row">
                       
                        <div class="form-group">
                            <label for="room-type">Room Type:</label>
                            <input type="text" id="room-type" name="room-type">
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
                            questions regarding this data privacy, feel free to let us know at hostel.nasugbu@g.batstate-u.edu.ph 
                        By signing, you are expressly giving your consent to the collection and storage
                            of your personal data as provided herein.

                        </p>
                </div> 
                
<!-- signiture -->
                <div >
                    <label for="signature-draw">Draw your signature below:</label><br>
                    <canvas id="signature-pad" class="signature-pad"></canvas><br>
                    <button type="button" onclick="clearSignature()">Clear Signature</button>
                    <input type="hidden" name="signature" id="signature-input">
                    <div class="upload-section mb-4">
                        <label for="signature-upload">Or upload your signature file:</label>
                        <input type="file" id="signature-upload" name="signature-file" accept="image/*">
                    </div>
                    <p id="error-message" style="display:none; color:red;">Please input a required information.</p>
                  
                </div>    
               <div class="submit-btn-container">
                 <button class="btn text-white shadow-none custom-bg" type="submit" onclick="return validateForm()">Submit</button>
               </div>
            </div>
        </div>
    </form>
</div>             
    <?php require('inc/footer.php');?>

   
    <script>

///this is for adding row

    let guestCount = 1; // Start with 1 guest already in the table

///addrow

    function addGuestRow() {
        const table = document.getElementById('guestTable');
        const row = table.insertRow(-1); // Add a new row at the end of the table
        guestCount++; // Increment guest count

        const cell1 = row.insertCell(0);
        const cell2 = row.insertCell(1);
        const cell3 = row.insertCell(2);
        const cell4 = row.insertCell(3);
        const cell5 = row.insertCell(4);

        cell1.className = 'center';
        cell1.innerHTML = guestCount + '.'; // Set the number
        cell2.className = 'center';
        cell2.innerHTML = `<input type="text" name="guest${guestCount}" style="width: 100%;" value="">`;
        cell3.className = 'center';
        cell3.innerHTML = `<input type="text" name="age${guestCount}" style="width: 50px;" value="">`;
        cell4.className = 'center';
        cell4.innerHTML = `<input type="date" name="dob${guestCount}" style="width: 100%;" value="">`;
        cell5.className = 'center';
        cell5.innerHTML = `<button type="button" onclick="deleteRow(this)">Delete</button>`;
    }

////delete row
    function deleteRow(button) {
        const row = button.parentNode.parentNode; // Get the row of the button
        row.parentNode.removeChild(row); // Remove the row
        updateRowNumbers(); // Call function to update row numbers
    }
////update number in row
    function updateRowNumbers() {
        const rows = document.querySelectorAll("#guestTable tr:not(:first-child)"); // Select all rows except the header
        guestCount = 0; // Reset count
        rows.forEach(row => {
            guestCount++; // Increment for each row
            const cell = row.cells[0];
            cell.innerHTML = guestCount + '.'; // Update number
        });
    }



////for signiture

var canvas = document.getElementById('signature-pad');
    var ctx = canvas.getContext('2d');
    var drawing = false;

    // Function to start drawing
    function startDrawing(e) {
        drawing = true;
        ctx.beginPath(); // Start a new path
        ctx.moveTo(e.offsetX || e.touches[0].pageX - canvas.offsetLeft, 
                   e.offsetY || e.touches[0].pageY - canvas.offsetTop);
        document.getElementById('signature-input').value = ''; // Clear the hidden input when starting a new drawing
    }

    // Function to draw on the canvas
    function draw(e) {
        if (drawing) {
            ctx.lineTo(e.offsetX || e.touches[0].pageX - canvas.offsetLeft, 
                       e.offsetY || e.touches[0].pageY - canvas.offsetTop);
            ctx.stroke();
        }
    }

    // Function to end drawing
    function endDrawing() {
        if (drawing) {
            drawing = false;
            document.getElementById('signature-input').value = canvas.toDataURL(); // Update hidden input with final signature
        }
    }

    // Handle touch events for mobile
    canvas.addEventListener('touchstart', function(e) {
        e.preventDefault();
        startDrawing(e);
    });

    canvas.addEventListener('touchmove', function(e) {
        e.preventDefault();
        draw(e);
    });

    canvas.addEventListener('touchend', endDrawing);

    // Handle mouse events for desktop
    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', endDrawing);

    // Clear Signature Pad
    function clearSignature() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        document.getElementById('signature-input').value = ''; // Clear hidden input
        document.getElementById('signature-upload').value = ''; // Clear file upload
    }

    // Validate Form
    function validateForm() {
        var signatureData = document.getElementById('signature-input').value;
        var signatureUpload = document.getElementById('signature-upload').files.length;

        // Check if both signature canvas and file upload are empty
        if (!signatureData && signatureUpload === 0) {
            document.getElementById('error-message').style.display = 'block';
            return false; // Prevent form submission
        }

        document.getElementById('error-message').style.display = 'none';
        return true; // Allow form submission
    }





////for date 
document.addEventListener('DOMContentLoaded', function() {
    // Get today's date in the format yyyy-mm-dd
    let today = new Date().toISOString().split('T')[0];

    // Set the min attribute for the arrival and departure date inputs
    document.getElementById("arrival-date").setAttribute("min", today);
    document.getElementById("departure-date").setAttribute("min", today);
});






</script>

  
    </body>
</html>