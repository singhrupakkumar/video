<section class="st-content">

      <section class="change-pass theme-marg">
        <div class="container">
            <div class="row">
                <?= $this->Flash->render() ?>   
                <div class="col-md-4 mx-auto">
                    <div class="change-inner float-left w-100" style="display: block;">
                            <h3 class="text-center mb-3 text-white">Reset Password</h3>
                            <p class="text-center mb-3 text-white">To change your password, Enter your new password in the given fields below</p>
                            <?= $this->Form->create('', ['type' => 'file', 'class' => 'form-horizontal','id' => 'reset-form']) ?>
                      
                            <div class="connect">

                                <div class="form-group">
                                 <input type="password" class="form-control" name="password1" id="password1" placeholder="New Password" required="required">
                                        
                                </div> 
                                
                                <div class="form-group">
                                   <input type="password" class="form-control" name="password" placeholder="Confirm Password" required="required">
                                </div> 
                            <?= $this->Form->button(__('Save'),['class'=>'theme-btn grey','id'=>'resetbutton']); ?>   

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
	$("#reset-form").validate({ 
		rules: {
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
			password1: "Password should be min. 6 and max. 15 characters long.",

			password: {
				equalTo: "Both Passwords do not match"
			}		
		}
	});
             
});
</script>