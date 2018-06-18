
  
   
   <section class="st-content">
    
    
      <div class="login theme-marg">
         <?= $this->Flash->render() ?>  
        <div class="container">
          <div class="row">
            
            
              <div class="col-md-4 col-sm-12">
                  <div class="login-lock text-white">
                      <h3>The free Sign Up for <br/> ppv service</h3>
                        <h4 style="margin-top: 15px;">simply dummy text of the printing and typesetting industry. Lorem Ipsum has
been the industry's standard dummy text</h4>
            <h3 style="margin: 30px 0px;">Benefits of our website</h3>
                        <ul class="m-0 p-0">
                          <li><i class="fa fa-check" aria-hidden="true"></i> simply dummy text of the printing</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> and typesetting industry.</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> Lorem Ipsum has been the</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> industry's standard</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> dummy text</li>
                        </ul>
                        
                        <div class="heart">
                          <img src="<?php echo $this->request->webroot; ?>images/lock.png" />
                        </div>
                        
                    </div>
                </div>
                
                <div class="col-md-8 col-sm-12">
                  <div class="signin">  
                        
                      
                        <div class="cardd float-left w-100">
                           
                        <form class="frm">
                          <div class="connect">
                            
                                
                                <div class="form-group">
                                  <label for="exampleNumber" class="text-white">CARD NUMBER</label>
                                     <input type="number" class="form-control" id="exampleNumber" placeholder="1234 - 4567 - 8901 - 2345">
                                </div>
                                
                                 <div class="form-group">
                                  <label for="exampletext" class="text-white">CARD HOLDER NAME</label>
                                     <input type="text" class="form-control" id="exampletext" placeholder="Jhon Peeter">
                                </div> 
                               
                               
                              <label for="exampletext" class="text-white">CARD EXPIRES</label>
                              <div class="form-row">
                                    <div class="form-group col-12 col-sm-6 col-lg-6">
                                
                  <select id="inputDate" class="form-control">
                                        <option selected>December</option>
                                        <option>...</option>
                                      </select>
                                    </div>
                                    <div class="form-group col-12 col-sm-6 col-lg-6">

                                      <select id="inputMonth" class="form-control">
                                        <option selected>2028</option>
                                        <option>...</option>
                                      </select>
                                    </div>
                                    
                                  </div><!--form-row-->
                                      
                            <button type="submit" class="theme-btn grey cards">Save</button>
                            
                             <div class=" skip">
                              <!--a class="text-white signins float-left" href="<?php echo $this->request->webroot; ?>users/login"><i class="fa fa-angle-left mr-1" aria-hidden="true"></i> BACK TO LOGIN</a-->
                                <a href="<?php echo $this->request->webroot; ?>users/myaccount" class="text-white float-right">SKIP <i class="fa fa-angle-right ml-1" aria-hidden="true"></i> </a>
                            </div>
                            
                                
                            </div>
                            
                            
                           
                            
                        </form>
                        </div>
                        <!--card-end-->
                        
               
                  </div>
                </div>
                
            </div>
        </div>  
      </div> 
    
    
   </section><!--st-content-end-->


<script>
 
$().ready(function() {
  var form = $("#user-form").validate({
    rules: {
      fname: "required",
      email: {
        required: true,
        email: true
      },
      phone: {
        required: true  
      },
      password1: { 
        required: true,
        minlength: 6
      },
      password: {
        equalTo: "#password1"
      }
    },
    messages: {
      name: "Please enter your first name",
      email: "Please enter a valid email address",
      password1: "Password is required",
      password: {
        equalTo: "Password and confirm password should be same"
      }
    }
  });
        

   jQuery("#signupbutton").click(function(event) {
          if(form.form()){  
          jQuery.ajax({
                    url: '<?php echo $this->request->webroot ;?>users/signup', 
                    data: jQuery('#user-form').serialize(),
                    type: 'POST',
                    dataType: "json",
                    success: function (msg) {    
                        if (msg.isSucess === true) 
                        {
                            jQuery(".mymessage").html(msg.msg); 
                        }
                        else
                        { 
                              event.preventDefault();
                            jQuery(".mymessage").html(msg.msg);
                        } 
                    }
                });
                }                 
  event.preventDefault();    
});
   
jQuery("#password2").keyup(function(event) {
    if (event.keyCode === 13) {
        jQuery("#signupbutton").click(); 
    }
});
 
 
});
</script>






