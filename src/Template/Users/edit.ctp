 
   <section class="st-content">
    
    
      <section class="edit theme-marg">
        <div class="container">
			
			           <div class="top-heading pt-0 pb-5 text-center">
                   	<h2 class="text-white">Edit Profile</h2>
                      <?= $this->Flash->render() ?> 
                 </div>
			
          <div class="row">
           
              <div class="col-md-7 mx-auto">
                   <?= $this->Form->create($user, ['id' => 'edit-form', 'enctype' => 'multipart/form-data']) ?>
                      <div class="subedit">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="prf-img text-center">
                                        <span class="info">
                                        <?php if($user['image']){ ?>
                                        <img class="currentimg" src="<?php echo $user['image']; ?>">
                                        <?php }else{ ?>
                                        <img class="currentimg" src="<?php echo $this->request->webroot."images/users/noimage.png"; ?>">
                                        <?php } ?>
                                    
                                        </span>
										<div class="input file">
										<input type="file" name="image" class="form-control" id="img">
										<span><i class="fa fa-camera" aria-hidden="true"></i></span>
										</div>
                                    </div>
                                </div><!--col-md-4-->
                                <div class="col-md-8">
                                    <div class="edit-frm">
                                              <div class="form-group">
                                                <label for="exampletext">First Name</label>
                                                <?php echo $this->Form->control('fname', ['class' => 'form-control', 'label' => false,'placeholder'=>'First Name']); ?>
                                              </div>

                                               <div class="form-group">
                                                <label for="exampletext">Last Name</label>
                                                <?php echo $this->Form->control('lname', ['class' => 'form-control', 'label' => false,'placeholder'=>'Last Name']); ?> 
                                              </div>

                                              <div class="form-group">
                                                  <label for="exampletext">E-mail address</label>
                                              <?php echo $this->Form->control('email', ['class' => 'form-control', 'label' => false,'placeholder'=>'Email Address','readonly']); ?>           
                                               </div>
                                               
                                               <div class="form-group">
                                                  <label for="exampletext">Address</label>
                                                <?php echo $this->Form->control('address', ['class' => 'form-control ctrl_smn', 'label' => false,'placeholder'=>'Address']); ?>        
                                               </div>
                                             
                                              <label for="exampletext">Date of Birth</label>
                                               <div class="form-row">

                                                  <div class="form-group">
                                                   <?php echo $this->Form->control('dob', ['dateFormat'=> 'DMY','maxYear' => date('Y') - 18,'minYear' => date('Y') - 70,'label' => false,'class' => 'form-control','type'=>'date','placeholder' => 'Last Name']); ?>
                                                  </div>
                                     
                                                </div><!--form-row-->
                                        
                                            <div class="form-group">
                                              <label for="exampletext"> Mobile</label>
                                              <?php echo $this->Form->control('phone', ['class' => 'form-control ctrl_smn', 'label' => false,'placeholder'=>'123-456-1234','maxlength'=>12]); ?>
                                            </div>
                                    </div>
                                </div><!--col-md-8-->
                             
                            </div>
                            
                    </div>
                    <div class="edit-btn">
                    <?= $this->Form->button(__('Save Changes'), ['class' => 'theme-btn theme-bg']) ?>
                      
                    </div>
                  
                    <?= $this->Form->end() ?>
              </div>
          </div>
       </div>
   </section> 
    
    
   </section><!--st-content-end-->


<script>
$(document).ready(function() {
	$("#edit-form").validate({  
		ignore: "",
		rules: {
			email: {
				required: true,
				email: true
			},
			fname: {required:true},
			dob: {required:true},
      phone: { 
            required:true,  
      }
			
		},
		messages: {
                          fname: {     
                                  required: "Please enter your First Name", 
                                },      
			dob: "Please select date of Birth",


      email: "Please enter a valid email address"
		}
	});
}); 

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.currentimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#img").change(function(){  
    readURL(this);
});
</script>    