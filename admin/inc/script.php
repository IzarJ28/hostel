<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<script>

//////alert function

    function alert(type,msg,position='body'){
     let bs_class = (type =='success') ? 'alert-success' : 'alert-danger';
     let element = document.createElement ('div');
     element.innerHTML = ` <div class="alert ${bs_class}  alert-dismissible fade show  " role="alert">
      <strong class="me-3">${msg}</strong> 
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    `;

    if (position=='body'){
        document.body.append(element);
        element.classList.add('custom-alert');/// to make the alert is on the add image modal for adding room
    }
    else{
        document.getElementById(position).appendChild(element);
    }
    setTimeout(remAlert, 2000);
    }
    function remAlert(){
        document.getElementsByClassName('alert')[0].remove();
    }

////set up to make the navbar is active


function setActive() {
    let navbar = document.getElementById('dashboard-menu');
    let a_tags = navbar.getElementsByTagName('a');
    let currentPath = window.location.pathname.split('/').pop(); // Get current page file name

    for (let i = 0; i < a_tags.length; i++) {
        let linkPath = a_tags[i].href.split('/').pop();

        if (linkPath === currentPath) {
            a_tags[i].classList.add('active');
        } else {
            a_tags[i].classList.remove('active');  // Remove active class from other links
        }
    }
}

setActive();



</script>