<section class="st-content">
    
    
      <div class="login theme-marg">

        <div class="container">
          <div class="row">
             <?= $this->Flash->render() ?>  
            
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
                      
                        <div class="sign float-left w-100">
                            <h3 class="text-center text-white mb-3">Sign In</h3>
                            <p class="text-center text-white">simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard
                            dummy text</p>
                            <p class="alert-box1"></p>
                         <?= $this->Form->create('Users', ['id' => 'login-form','class'=>'frm']) ?>   
                          <div class="connect">
                              
                                  <div class="form-group">
                                     <input id="email" type="email" class="form-control" name="username" placeholder="Email Address" required="required"> 
                                       
                                      </div>
                                      <div class="form-group">
                                        <input id="password" type="password" class="form-control" name="password" placeholder="Password" required="required">
                                       
                                      </div>
                                      <a href="<?php echo $this->request->webroot; ?>users/forgot" class="text-white forgot-pass">Forgot Password?</a>
                                     <?= $this->Form->button(__('Sign In'),['class'=>'theme-btn grey','type'=>'submit','id'=>'loginbutton']); ?> 
                                     
                                
                            </div>
                            
                            <div class="or text-white">
                              <span>or</span>
                            </div>
                            
                            <div class="social">
                              <h3 class="text-white">Connect With</h3>
                                <p class="mb-3 text-white">simply dummy text of the printing and type.
Lorem Ipsum has been the industry's stand
dummy text</p>
                            <a href="javascript:void(0)" class="float-left mb-2 fb omb_login"><img src="<?php echo $this->request->webroot; ?>images/fb.png" /></a>
                            
                            <a href="javascript:void(0)" id="customBtn1" class="float-left"><img src="<?php echo $this->request->webroot; ?>images/google.png" /></a>
                             <script>startApp();</script> 
                            </div>
                            
                            <div class="dont">
                              <h5 class="text-white">Don't have and an account?</h5>
                              <a class="text-white sign-ups" href="<?php echo $this->request->webroot; ?>users/add">Sign Up <img src="<?php echo $this->request->webroot; ?>images/arrow.png" /></a>
                            </div>
                            
                        <?= $this->Form->end() ?> 
                        </div>
                        <!--login-end-->

                    </div>
                </div>
                
            </div>
        </div>  
      </div> 
    
    
   </section><!--st-content-end-->







