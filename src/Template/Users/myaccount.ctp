
 
   <section class="st-content">
    
    
      <section class="profile theme-marg">
        <div class="container">
			<div class="top-heading pt-0 pb-5 text-center">
                   	<h2 class="text-white">My Profile</h2>
                 </div>
            <div class="row">
                <?= $this->Flash->render() ?> 
                <div class="col-md-8 mx-auto">
                    <div class="prf-inner grey">
                        <div class="row">
                        <div class="col-md-4">
                            <div class="prf-img text-center mb-3">
                                <span class="info">
                                    <?php if(isset($userdata->image)){  ?>    
                                    <img src="<?php echo $userdata->image; ?>">
                                    <?php }else{  ?>
                                    <img src="<?php echo $this->request->webroot."images/users/noimage.png"?>">
                                    <?php } ?>
                                </span> 
                                <a href="<?php echo $this->request->webroot."users/edit/".$userdata->id; ?>">
                                    <button class="theme-btn theme-bg w-100">Edit Profile</button>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail">
                              
                                 <?php if(!empty($userdata->fname)){ ?>
                                <h3 class="mb-0">Username</h3>
                                <h4 class="mb-0"><?php if(isset($userdata->fname)){ echo $userdata->fname; } ?> <?php if(isset($userdata->lname)){ echo $userdata->lname; } ?></h4>
                                <?php } ?>
                            </div>
                            
                            <div class="detail">
                                 <?php if(!empty($userdata->email)){ ?>
                             
                                <h3 class="mb-0">E-mail Address</h3>
                                <h4 class="mb-0"><?php if(isset($userdata->email)){ echo $userdata->email; } ?></h4>
                                <?php } ?>
                            </div>
                            
                            <div class="detail">
                                <?php if(!empty($userdata->address)){ ?>
                                <h3 class="mb-0">Address</h3>
                                <h4 class="mb-0"><?php if(isset($userdata->address)){ echo $userdata->address; } ?></h4>
                                 <?php } ?>
                            </div>
                            
                            <div class="detail mb-md-0">
                                <?php if(!empty($userdata->dob)){ ?>
                             
                                <h3 class="mb-0">Date of Birth</h3>
                                <h4 class="mb-0"><?php if(isset($userdata->dob)){ echo $userdata->dob; } ?></h4>
                                <?php } ?>
                            </div>
                            
                        </div>
                        <div class="col-md-4">
                            <div class="detail">
                                <?php if(!empty($userdata->phone)){ ?>
                              
                                <h3 class="mb-0">Mobile</h3>
                                <h4 class="mb-0"><?php if(isset($userdata->phone)){ echo $userdata->phone; } ?></h4>
                                <?php } ?>
                            </div>
                         
                     
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
      </section> 
    
    
   </section><!--st-content-end-->
    
