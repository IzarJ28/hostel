



   let hostel_s_form = document.getElementById('hostel_s_form');
   let hostel_picture_input = document.getElementById('hostel_picture_input');


  
     
    hostel_s_form.addEventListener('submit',function(e){
      e.preventDefault();
      add_image();
    });

    ///added member function

    function add_image()
    {
      let data = new FormData();
      data.append('picture',hostel_picture_input.files[0]);
      data.append('add_image','');

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/hostel_crud.php",true);
        
        xhr.onload =function(){

          var myModal = document.getElementById('hostel-s');
          var modal = bootstrap.Modal.getInstance(myModal);
          modal.hide();

          if (this.responseText =='inv_img')
        {
          alert('error','Only JPG and PNG images are allowed!');
        }
        else if (this.responseText =='inv_size'){
          alert('error','Images should be less than 2mb!');
        }
        else if (this.responseText =='upd_failed'){
          alert('error','Image upload failed!');
        }
        else{
          alert ('success','New Image Added');
          hostel_picture_input.value='';
          get_hostel();
        }
        
        }

        xhr.send(data);

    }

 //get  data for hostel
    function get_hostel()
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/hostel_crud.php",true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      xhr.onload =function(){
        document.getElementById('hostel-data').innerHTML = this.responseText;
       
      }

      

      xhr.send('get_hostel');
    }

    function rem_image(val)
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/hostel_crud.php",true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      xhr.onload =function(){
       if (this.responseText == 1){
        alert('success','Image has been deleted!');
        get_hostel();
       }
       else {
        alert('error','Server Down')
       }
      }

      xhr.send('rem_image='+val);
    }

      window.onload = function(){
        get_hostel();
      }


