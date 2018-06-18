
   <section class="st-content">
    
    
      <section class="change-pass theme-marg">
        <div class="container">
				<div class="top-heading pt-0 pb-5 text-center">
                   	<h2 class="text-white">Change Password</h2>
                 </div>
            <div class="row">
                <?= $this->Flash->render() ?>   
                <div class="col-md-5 mx-auto">
                    <div class="change-inner float-left w-100">
                            <p class="text-center mb-3 text-white">To change your password, Enter your current password in the given fields below</p>
                            <?= $this->Form->create('', ['type' => 'file', 'id' => 'change-from','class'=>'change-form text-center']) ?>
                      
                            <div class="connect">
                                
                                <div class="form-group">
                                    <input type="password" placeholder="Enter Your Old Password" name="opassword" class="form-control" id="opassword">
                                       
                                </div> 
                                
                                <div class="form-group">
                                      <input type="password" class="form-control" placeholder="Enter Your New Password" name="password1" id="password1">
                                        
                                </div> 
                                
                                <div class="form-group">
                                       <input type="password" class="form-control" placeholder="Confirm Password" name="password">
                                </div> 
                             <?= $this->Form->button(__('Change Password'),['class'=>'theme-btn grey']); ?>   

                            </div>
                            
                       
                        <?= $this->Form->end() ?>
                        </div>
                </div>
            </div>
        </div>
      </section> 
    
    
   </section><!--st-content-end-->

<script>
 $(document).ready(function() {
         $("#change-from").validate({
                 rules: { 
                        opassword: "required",
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
                         opassword: "Please enter your old password",
                         password1: "Password should be min. 6 and max. 15 characters long.", 
                         password: {
                                 equalTo: "Password and confirm password should be same"
                         }		
                 }
         });
 });
 </script>
