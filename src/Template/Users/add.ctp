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
                        
                        <div class="signup float-left w-100">
                            <h3 class="text-center mb-3 text-white">Get started absolutely FREE</h3>
                            <p class="text-center text-white">By creating an account, you confirm that you accept the User Agreement.
Note, we truly respect your confidentiality. See our Privacy Policy for more details
                            dummy text</p>
                            <p class="mymessage" ></p> 
                       <?= $this->Form->create($user, ['type' => 'file','id' => 'user-form','class'=>'frm']) ?>
                          <div class="connect">
                              <div class="form-row">
                                  <div class="col-12 col-sm-6 col-lg-6">
                                      <div class="form-group">
                                            <?php echo $this->Form->control('fname', ['label' => false,'class' => 'form-control','placeholder' => 'First Name']); ?>
                                       
                                      </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-6">
                                      <div class="form-group">
                                      <?php echo $this->Form->control('lname', ['label' => false,'class' => 'form-control','placeholder' => 'Last Name']); ?>
        
                                      </div>
                                    </div>
                                </div><!--form-row-->
                                  
                                <div class="form-group  <?= ($this->Form->isFieldError('email'))? 'has-error': '' ; ?>">

                                  <input name="email" class="form-control" placeholder="Email Address" type="email" value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>">
                               <?php echo $this->Form->error('email', null, array('class' => 'label label-block label-danger text-left', 'wrap' => 'label')); ?>
                                </div>  
                                
                                <label for="exampletext" class="text-white">Date of Birth</label>
                                <div class="form-row">

                                    <div class="form-group">
                                     <?php echo $this->Form->control('dob', ['maxYear' => date('Y') - 18,'minYear' => date('Y') - 70,'label' => false,'class' => 'form-control','type'=>'date','placeholder' => 'Last Name']); ?>
                                    </div>
                       
                                  </div><!--form-row-->
                                  
                                  <div class="form-row">
                                  <div class="col-12 col-sm-6 col-lg-6">
                                      <div class="form-group">
                                        <input name="password1" class="form-control" placeholder="Password" id="password1" type="password">
                                   
                                      </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-6">
                                      <div class="form-group">
                                         <input name="password" class="form-control" placeholder="Confirm Password" id="password2" type="password">
                                  
                                      </div>
                                    </div>
                                </div><!--form-row-->
                                <?= $this->Form->button(__('Continue'),['class'=>'theme-btn grey cards','id'=>'signupbutton','type'=>'submit']); ?>  
                                     
                                
                            </div>
                            
                            
                            <div class="dont">
                              <h5 class="text-white">Already have and an account?</h5>
                              <a class="text-white signins" href="<?php echo $this->request->webroot; ?>users/login">Sign In <img src="<?php echo $this->request->webroot; ?>images/arrow.png" /></a>
                            </div>
                            
                       <?= $this->Form->end() ?>  
                        </div>
                        <!--signup-end-->
                        
               
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
        minlength: 6,
        maxlength: 15 
      },
      password: {
        equalTo: "#password1" 
      }
    },
    messages: {
      name: "Please enter your first name",
      email: "Please enter a valid email address",
      password1: "Password should be min. 6 and max. 15 characters long.",
      password: {
        equalTo: "Password and confirm password should be same"
      }
    }
  });
        

//    jQuery("#signupbutton").click(function(event) {
//           if(form.form()){  
//           jQuery.ajax({
//                     url: '<?php echo $this->request->webroot ;?>users/signup', 
//                     data: jQuery('#user-form').serialize(),
//                     type: 'POST',
//                     dataType: "json",
//                     success: function (msg) {    
//                         if (msg.isSucess === true) 
//                         {
//                             jQuery(".mymessage").html(msg.msg); 
//                         }
//                         else
//                         { 
//                               event.preventDefault();
//                             jQuery(".mymessage").html(msg.msg);
//                         } 
//                     }
//                 });
//                 }                 
//   event.preventDefault();    
// });
   
// jQuery("#password2").keyup(function(event) {
//     if (event.keyCode === 13) {
//         jQuery("#signupbutton").click(); 
//     }
// });
 
 
});
</script>






