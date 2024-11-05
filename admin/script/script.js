

   let general_data, contacts_data;

   let general_s_form =document.getElementById('general_s_form');

   let site_title_input = document.getElementById('site_title_input');
   let site_about_input = document.getElementById('site_about_input');

   let contacts_s_form =document.getElementById('contacts_s_form');

   let team_s_form = document.getElementById('team_s_form');
   let member_name_input = document.getElementById('member_name_input');
   let member_picture_input = document.getElementById('member_picture_input');


    // get data for genral setting-->

    function get_general()
    {
      let site_title = document.getElementById('site_title');
      let site_about = document.getElementById('site_about');

      let shutdown_toggle = document.getElementById('shutdown-toggle');

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/settings_crud.php",true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      xhr.onload =function(){
        general_data = JSON.parse(this.responseText);
        
        site_title.innerText = general_data.site_title;
        site_about.innerText = general_data.site_about;

        site_title_input.value = general_data.site_title;
        site_about_input.value = general_data.site_about;

        if (general_data.shutdown == 0){
          shutdown_toggle.checked = false;
          shutdown_toggle.value = 0 ;
        }
        else{
          shutdown_toggle.checked = true;
          shutdown_toggle.value = 1 ;
        }

      }

      

      xhr.send('get_general');

    }

    general_s_form.addEventListener('submit',function(e){
      e.preventDefault();
      upd_general(site_title_input.value,site_about_input.value);
    });


    // upadete data for generqal setting

    function upd_general(site_title_val,site_about_val)
    {
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/settings_crud.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload =function(){

          var myModal = document.getElementById('general-s');
          var modal = bootstrap.Modal.getInstance(myModal);
          modal.hide();

        

          if (this.responseText ==1)
        {
          alert('success','Changes Saved!');
          get_general();
        }
        else
        {
          alert('error','No Changes Made!');
        }
        
        }

        xhr.send('site_title='+site_title_val+'&site_about='+site_about_val+'&upd_general');
    }

    

    //shutdwown 

    function upd_shutdown(val)
    {
      let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/settings_crud.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload =function(){

          if (this.responseText ==1 && general_data.shutdown==0)
        {
          alert('success','Site has been shutdown!');
        }
        else
        {
          alert('success','Shutdwon mode off!');
        }
        get_general();
        }

        xhr.send('upd_shutdown='+val);

    }


    
    /// fror contact us-->

    function get_contacts()
      {

        let contact_p_id = ['address','gmap','pn1','pn2','email','fb'];
        let iframe = document.getElementById('iframe');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/settings_crud.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload =function(){
          contacts_data = JSON.parse(this.responseText);
          contacts_data = Object.values(contacts_data);
        
          for (i=0;i<contact_p_id.length;i++){
            document.getElementById(contact_p_id[i]).innerText = contacts_data[i+1];
          }
          iframe.src = contacts_data [7];
          contacts_inp (contacts_data);
        }

        xhr.send('get_contacts');

      }

   
   ///for submiiting data for contact us
      function contacts_inp(data)
    {
       let contacts_inp_id = ['address_input','gmap_input','pn1_input','pn2_input','email_input','fb_input','iframe_input'];

       for(i=0;i<contacts_inp_id.length;i++){
        document.getElementById(contacts_inp_id[i]).value = data[i+1];
       }

    }

    contacts_s_form.addEventListener('submit',function(e){
      e.preventDefault();
      upd_contacts();
    });
 ///update data for contact us     
    function upd_contacts()
    {
      let index = ['address','gmap','pn1','pn2','email','fb','iframe'];
      let contacts_inp_id = ['address_input','gmap_input','pn1_input','pn2_input','email_input','fb_input','iframe_input'];

      let data_str = "";

      for(i=0;i<index.length;i++){
        data_str +=index[i] + "=" +document.getElementById(contacts_inp_id[i]).value + '&';
      }
       data_str += "upd_contacts";

       let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/settings_crud.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload =function(){
          var myModal = document.getElementById('contact-s');
          var modal = bootstrap.Modal.getInstance(myModal);
          modal.hide();

          if (this.responseText ==1)
        {
          alert('success','Changes saved!');
          get_contacts();
        }
        else
        {
          alert('error','No Changes Made!');
        }

      }

        xhr.send(data_str);

    }
     
    team_s_form.addEventListener('submit',function(e){
      e.preventDefault();
      add_member();
    });

    ///added member function

    function add_member()
    {
      let data = new FormData();
      data.append('name',member_name_input.value);
      data.append('picture',member_picture_input.files[0]);
      data.append('add_member','');

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/settings_crud.php",true);
        
        xhr.onload =function(){

          var myModal = document.getElementById('team-s');
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
          alert ('success','New Memeber Added');
          member_name_input.value='';
          member_picture_input.value='';
          get_members();
        }
        
        }

        xhr.send(data);

    }

 //get  data formembers
    function get_members()
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/settings_crud.php",true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      xhr.onload =function(){
        document.getElementById('team-data').innerHTML = this.responseText;
       
      }

      

      xhr.send('get_members');
    }

    function rem_member(val)
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/settings_crud.php",true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      xhr.onload =function(){
       if (this.responseText == 1){
        alert('success','Member has been deleted!');
        get_members();
       }
       else {
        alert('error','Server Down')
       }
      }

      xhr.send('rem_member='+val);
    }

      window.onload = function(){
        get_general();
        get_contacts();
        get_members();
      }



      