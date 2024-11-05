// // Show modal on page load
// window.addEventListener('load', function() {
//   const modal = document.getElementById("guidelinesModal");
//   const closeBtn = document.querySelector(".modal .close");

//   // Display the modal
//   modal.style.display = "block";

//   // Close the modal and redirect to the previous page when the close button is clicked
//   closeBtn.onclick = function() {
//       modal.style.display = "none";
//       window.history.back(); // Go back to the previous page
//   };
// });

// // Function for the "Cancel" button
// function cancelAgreement() {
//   document.getElementById("guidelinesModal").style.display = "none";
//   window.history.back(); // Redirect to the previous page
// }

// // Submit Agreement function
// function submitAgreement() {
//   const checkbox = document.getElementById("acknowledgementCheckbox");

//   // Ensure the checkbox is checked before proceeding
//   if (checkbox.checked) {
//       document.getElementById("guidelinesModal").style.display = "none";
//   } else {
//       alert("Please acknowledge the guidelines by checking the box.");
//   }
// }

////for date 
document.addEventListener('DOMContentLoaded', function() {
  // Get today's date in the format yyyy-mm-dd
  let today = new Date().toISOString().split('T')[0];

  // Set the min attribute for the arrival and departure date inputs
  document.getElementById("arrival-date").setAttribute("min", today);
  document.getElementById("departure-date").setAttribute("min", today);
});


  // For  Get the modal
var modal = document.getElementById("guidelinesModal");
var span = document.getElementsByClassName("close")[0];

// Show the modal when the page loads
window.onload = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal and go back to the previous page
span.onclick = function() {
  modal.style.display = "none";
  window.history.back(); // Go back to the previous page
}



// When the user clicks anywhere outside of the modal, close it and go back to the previous page
window.onclick = function(event) {
  if (event.target == modal) {
      modal.style.display = "none";
      window.history.back(); 
  }
}







