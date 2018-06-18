
   
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

                        <div class="for float-left w-100">
                            <h3 class="text-center mb-3 text-white">Forgot Password</h3>
                            <p class="text-center text-white">Don't worry just fill in your email and we'll help
to reset your password.</p>
                        <?= $this->Form->create('', ['type' => 'file','id' => 'forgot-form','class'=>'frm']) ?>
                       
                          <div class="connect">
                              
                                <div class="form-group">
                                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter your email address" required="required">
                                </div> 
                            <?= $this->Form->button(__('Send'),['class'=>'theme-btn grey','id'=>'forgotbutton','type'=>'submit']); ?>
                            </div>
                            
                            
                            <div class="dont">
                              <a class="text-white signins back-log" href="<?php echo $this->request->webroot; ?>users/login"><i class="fa fa-angle-left mr-1" aria-hidden="true"></i> BACK TO LOGIN</a>
                            </div>
                            
                         <?= $this->Form->end() ?>
                        </div>
                        <!--forgot-end-->
                        
                      
                        
                    </div>
                </div>
                
            </div>
        </div>
      </div> 
    
    
   </section><!--st-content-end-->

<script>
//    jQuery("#forgotbutton").click(function(event) { 
            
//           jQuery.ajax({
//                     url: '<?php echo $this->request->webroot ;?>users/capchaverify', 
//                     data: jQuery('#forgot-form').serialize(),
//                     type: 'POST',
//                     dataType: "json",
//                     success: function (msg) {    
//                         if (msg.status === true) 
//                         {
//                             jQuery(".mymessage").html(msg.msg); 
//                             jQuery("#forgot-form").submit();  
//                         }
//                         else
//                         { 
//                               event.preventDefault();
//                             jQuery(".mymessage").html(msg.msg);
//                         }
//                     }
//                 });
//   event.preventDefault();    
// });
</script> 
  