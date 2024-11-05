

let banguet_s_form = document.getElementById('banguet_s_form');


banguet_s_form.addEventListener('submit',function(e){
    e.preventDefault();
    add_banguet();
  });

// adding banguet
  function add_banguet()
    {
      let data = new FormData();
      data.append('name',banguet_s_form.elements['banguet_name'].value);
      data.append('image',banguet_s_form.elements['banguet_image'].files[0]);
      data.append('desc',banguet_s_form.elements['banguet_desc'].value);
      data.append('add_banguet','');

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/banguet.php",true);
        
      xhr.onload = function() {
        console.log(this.responseText);
        var myModal = document.getElementById('banguet-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();
      
        if (this.responseText == 'inv_img') {
          alert('error', 'Only JPEG, PNG, and WebP images are allowed!');
        } else if (this.responseText == 'inv_size') {
          alert('error', 'Images should be less than 2MB!');
        } else if (this.responseText == 'upd_failed') {
          alert('error', 'Image upload failed!');
        } else {
          alert('success', 'New Banguet Added');
          banguet_s_form.reset();
          // Optionally refresh the banquet list
          get_banguet();

        }
      }
        xhr.send(data);

    }


    //get banguet
function get_banguet()
{
let xhr = new XMLHttpRequest();
xhr.open("POST","ajax/banguet.php",true);
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

xhr.onload =function(){
  document.getElementById('banguets-data').innerHTML = this.responseText;
 
}



xhr.send('get_banguet');
}


//remove banguet
    function rem_banguet(val)
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/banguet.php",true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      xhr.onload =function(){
       if (this.responseText == 1){
        alert('success','Banguet has been deleted!');
        get_banguet();
       }
       else {
        alert('error','Server Down')
       }
      }

      xhr.send('rem_banguet='+val);
    }

window.onload = function() {
    get_banguet();
};
