

let add_room_form = document.getElementById('add_room_form');

add_room_form.addEventListener('submit', function(e){
  e.preventDefault();
  add_room();
});

/// adding room 
function add_room() {
  let data = new FormData();
  data.append('add_room', '');
  data.append('name', add_room_form.elements['name'].value);
  data.append('area', add_room_form.elements['area'].value);
  data.append('price', add_room_form.elements['price'].value);
  data.append('quantity', add_room_form.elements['quantity'].value);
  data.append('desc', add_room_form.elements['desc'].value);
  data.append('type_id', add_room_form.elements['type_id'].value); // Added type_id

  let features = [];
  add_room_form.elements['features'].forEach(el => {
      if (el.checked) {
          features.push(el.value);
      }
  });
  data.append('features', JSON.stringify(features));

  let facilities = [];
  add_room_form.elements['facilities'].forEach(el => {
      if (el.checked) {
          facilities.push(el.value);
      }
  });
  data.append('facilities', JSON.stringify(facilities));

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/rooms.php", true);

  xhr.onload = function() {
      var myModal = document.getElementById('add-room');
      var modal = bootstrap.Modal.getInstance(myModal);
      modal.hide();

      if (this.responseText == 1) {
          alert('success', 'New Room Added');
          add_room_form.reset();
          get_all_rooms();
      } else {
          alert('error', 'Server Down');
      }
  };

  xhr.send(data);
}


////get rooms deatails      
function get_all_rooms()
{
let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/rooms.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      
      xhr.onload =function(){
       document.getElementById('room-data').innerHTML = this.responseText;
      }

      xhr.send('get_all_rooms');
}


////to edit details of room
let edit_room_form = document.getElementById('edit_room_form');

function edit_details(id)
{
let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/rooms.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      
      xhr.onload =function(){
        let data = JSON.parse(this.responseText);

        edit_room_form.elements['name'].value = data.roomdata.name;
        edit_room_form.elements['type_id'].value = data.roomdata.type_id; 
        edit_room_form.elements['area'].value = data.roomdata.area;
        edit_room_form.elements['price'].value = data.roomdata.price;
        edit_room_form.elements['quantity'].value = data.roomdata.quantity;
        edit_room_form.elements['desc'].value = data.roomdata.description;
        edit_room_form.elements['room_id'].value = data.roomdata.id;


        //for features checkbox
        edit_room_form.elements['features'].forEach(el =>{
          if(data.features.includes(Number(el.value))){
            el.checked = true;
          }
        });

        ///for facilities check box 
        edit_room_form.elements['facilities'].forEach(el =>{
          if(data.facilities.includes(Number(el.value))){
            el.checked = true;
          }
        });
         
      }

      xhr.send('get_room='+id);

}

//submit edit deteails
edit_room_form.addEventListener('submit', function(e){
  e.preventDefault();
  submit_edit_room();
});

function submit_edit_room()
{
  let data = new FormData();
  data.append('edit_room','');
  data.append('room_id',edit_room_form.elements['room_id'].value);

   data.append('name',edit_room_form.elements['name'].value);
   data.append('type_id', edit_room_form.elements['type_id'].value); 
   data.append('area',edit_room_form.elements['area'].value);
   data.append('price',edit_room_form.elements['price'].value);
   data.append('quantity',edit_room_form.elements['quantity'].value);
   data.append('desc',edit_room_form.elements['desc'].value);

   let features = [];
   
   edit_room_form.elements['features'].forEach(el =>{
    if(el.checked){
      features.push(el.value);
    }
   });

   let facilities = [];
   
   edit_room_form.elements['facilities'].forEach(el =>{
    if(el.checked){
      facilities.push(el.value);
    }
   });
    
   data.append('features',JSON.stringify(features));
   data.append('facilities',JSON.stringify(facilities));

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/rooms.php",true);
      
      xhr.onload =function(){

        var myModal = document.getElementById('edit-room');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1){
        alert ('success','Room Data Edited');
        edit_room_form.reset();
        get_all_rooms();
        }
      else{
        alert('error','Server Down');
      }
      
      }

      xhr.send(data);

}

//// update the status 
function toggle_status(id,val)
{
let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/rooms.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      
      xhr.onload =function(){
      if (this.responseText==1){
        alert('success','Status Change');
        get_all_rooms();
      }
      else{
        alert('error','Server Down');
        get_all_rooms();
      }
      }

      xhr.send('toggle_status='+id+'&value='+val);
}




//submitting image from form
let add_image_form = document.getElementById('add_image_form');

add_image_form.addEventListener('submit', function(e){
e.preventDefault();
add_image();

});


//add image for rooms

function add_image()
{
let data = new FormData();
data.append('image',add_image_form.elements['image'].files[0]);
data.append('room_id',add_image_form.elements['room_id'].value);
data.append('add_image','');

let xhr = new XMLHttpRequest();
xhr.open("POST","ajax/rooms.php",true);
  
  xhr.onload =function()
  {
      if (this.responseText =='inv_img')
    {
      alert('error','Only JPG, WEBP or PNG images are allowed!','image-alert');
    }
    else if (this.responseText =='inv_size'){
      alert('error','Images should be less than 2mb!','image-alert');
    }
    else if (this.responseText =='upd_failed'){
      alert('error','Image upload failed!','image-alert');
    }
    else{
      alert ('success','New Image Added','image-alert');
      room_images(add_image_form.elements['room_id'].value,document.querySelector("#room-images .modal-title").innerText);//to show the add image in modal and  refresh the images in the modal
      add_image_form.reset();
      
    }
    
  }
  xhr.send(data);
}

///get room images and details  in modal
function room_images(id,rname)
{
document.querySelector("#room-images .modal-title").innerText = rname;
add_image_form.elements['room_id'].value = id;
add_image_form.elements['image'].value = '';

let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/rooms.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      
      xhr.onload =function(){
     document.getElementById('room-image-data').innerHTML =this.responseText;
      }

      xhr.send('get_room_images='+id);
}

///removed/delete image 
function rem_image(img_id,room_id)
{
let data = new FormData();
data.append('image_id',img_id);
data.append('room_id',room_id);
data.append('rem_image','');

let xhr = new XMLHttpRequest();
xhr.open("POST","ajax/rooms.php",true);
  
  xhr.onload =function()
  {
      if (this.responseText ==1)
    {
      alert ('success','Image Removed','image-alert');
      room_images(room_id,document.querySelector("#room-images .modal-title").innerText);   //This will refresh the images in the modal
      // room_images(room_id); // This will refresh the images in the modal
    }
    else{
      alert('error','Image Remove Failed','image-alert');
    }
    
  }
  xhr.send(data);
}

//thum image 
function thumb_image(img_id,room_id)
{
let data = new FormData();
data.append('image_id',img_id);
data.append('room_id',room_id);
data.append('thumb_image','');

let xhr = new XMLHttpRequest();
xhr.open("POST","ajax/rooms.php",true);
  
  xhr.onload =function()
  {
      if (this.responseText ==1)
    {
      alert ('success','Image Thumbnail Change','image-alert');
      room_images(room_id,document.querySelector("#room-images .modal-title").innerText);   //This will refresh the images in the modal
      // room_images(room_id); // This will refresh the images in the modal
    }
    else{
      alert('error','Thumbnail Update Failed','image-alert');
    }
    
  }
  xhr.send(data);
}

/// remove room
function remove_room(room_id)
{
if (confirm("Are you sure, you want to delete this room"))
{
let data = new FormData();
data.append('room_id',room_id);
data.append('remove_room','');

let xhr = new XMLHttpRequest();
xhr.open("POST","ajax/rooms.php",true);
  
  xhr.onload =function()
  {
      if (this.responseText ==1)
    {
      alert('success','Room Delete');
      get_all_rooms();
    }
    else{
      alert('error','Deleting Room Failed');
    }
    
  }
  xhr.send(data);
}


}


////types of rooms function 


let types_room_s_form = document.getElementById('types_room_s_form');


types_room_s_form.addEventListener('submit',function(e){
    e.preventDefault();
    add_types_room();
  });

// adding types of room
  function add_types_room()
    {
      let data = new FormData();
      data.append('name',types_room_s_form.elements['types_room_name'].value);
      data.append('image',types_room_s_form.elements['types_room_image'].files[0]);
      data.append('desc',types_room_s_form.elements['types_room_desc'].value);
      data.append('add_types_room','');

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/rooms.php",true);
        
      xhr.onload = function() {
        console.log(this.responseText);
        var myModal = document.getElementById('types_room-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();
      
        if (this.responseText == 'inv_img') {
          alert('error', 'Only JPEG, PNG, and WebP images are allowed!');
        } else if (this.responseText == 'inv_size') {
          alert('error', 'Images should be less than 2MB!');
        } else if (this.responseText == 'upd_failed') {
          alert('error', 'Image upload failed!');
        } else {
          alert('success', 'New Types of Rooms Added');
          types_room_s_form.reset();
          // Optionally refresh the banquet list
          get_types_room();

        }
      }
        xhr.send(data);

    }


    //get types_room
function get_types_room()
{
let xhr = new XMLHttpRequest();
xhr.open("POST","ajax/rooms.php",true);
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

xhr.onload =function(){
  document.getElementById('types_rooms-data').innerHTML = this.responseText;
 
}



xhr.send('get_types_room');
}


//remove types_room
    function rem_types_room(val)
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/rooms.php",true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      xhr.onload =function(){
       if (this.responseText == 1){
        alert('success','Types of Rooms has been deleted!');
        get_types_room();
       }
       else {
        alert('error','Server Down')
       }
      }

      xhr.send('rem_types_room='+val);
    }


///edit types of room 

let types_room_form = document.getElementById('edit_types_room_form');

function edit_types_room(id) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/rooms.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Handle the response
    xhr.onload = function() {
        let data = JSON.parse(this.responseText);
        console.log(data); // debugg

        if (data) {
            types_room_form.elements['types_room_name'].value = data.name;
            types_room_form.elements['types_room_desc'].value = data.description;
            types_room_form.elements['types_room_id'].value = data.id;

            let currentImageName = document.getElementById('current_image_name');
            if (currentImageName && data.image) {
                currentImageName.textContent = data.image; // Set the image name
                currentImageName.style.display = 'block'; // Show the image name
            } else {
                currentImageName.style.display = 'none'; // Hide if no image name is available
            }

        }
    };

    xhr.send('get_type_room=' + id);
}



///submit a edit data 

types_room_form.addEventListener('submit', function(event) {
  event.preventDefault(); 
  submit_edit_types_room(); 
});


function submit_edit_types_room() {
  let data = new FormData();
  
  // Collect form data
  data.append('id', types_room_form.elements['types_room_id'].value);
  data.append('name', types_room_form.elements['types_room_name'].value);
  data.append('image', types_room_form.elements['types_room_image'].files[0]);
  data.append('desc', types_room_form.elements['types_room_desc'].value);
  data.append('edit_types_room', ''); 

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/rooms.php", true);
  
  xhr.onload = function() {
      console.log(this.responseText);
      let myModal = document.getElementById('edit_types_room_modal');
      let modal = bootstrap.Modal.getInstance(myModal);
      modal.hide();

      // Handle the response
      if (this.responseText == 'inv_img') {
          alert('error', 'Only JPEG, PNG, and WebP images are allowed!');
      } else if (this.responseText == 'inv_size') {
          alert('error', 'Images should be less than 2MB!');
      } else if (this.responseText == 'upd_failed') {
          alert('error', 'Image upload failed!');
      } else {
          alert('success', 'Room Type Updated Successfully');
          types_room_form.reset();
          // refresh data
          get_types_room();
      }
  };

  xhr.send(data);
}




window.onload =function(){
get_all_rooms();
get_types_room();

}
