

   <section class="st-content">
    
    
      <section class="contactus theme-marg">
        <div class="container">
          <div class="row">
             <?= $this->Flash->render() ?>  
              <div class="col-md-6 mx-auto">
                
                  <div class="top-heading pt-0 pb-5 text-center">
                        <h2 class="text-white">CONTACT US</h2>
                        <h4 class="text-white">We are happy to hear from you</h4>
                  </div>
                
                  <div class="change-inner grey float-left w-100" style="display: block;">
                           
                       <?= $this->Form->create(null, ['type' => 'file','id' => 'contact-form']) ?>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                               <?php echo $this->Form->control('name', ['label' => false,'class' => 'form-control','placeholder'=>'Name']); ?> 
                     
                            </div>
                            <div class="form-group col-md-6">
                              <?php echo $this->Form->control('email', ['label' => false,'class' => 'form-control','type'=>'email','placeholder'=>'Your Email']); ?> 
                            
                            </div>
                          </div>
                          
                          
                          <div class="form-row">
                            <div class="form-group col-md-6">
                              <?php echo $this->Form->control('phone', ['label' => false,'class' => 'form-control','type'=>'tel','placeholder'=>'Phone']); ?> 
                            </div>
                            
                            <div class="form-group col-md-6">
                               <?php echo $this->Form->control('subject', ['label' => false,'class' => 'form-control','type'=>'text','placeholder'=>'Subject']); ?> 
                            </div>
                          </div>
                          
                           <div class="form-group">
                            <?php echo $this->Form->control('message', ['label' => false,'class' => 'form-control','type'=>'textarea','rows'=>3,'placeholder'=>'Message']); ?> 
                          </div>
                            <?= $this->Form->button(__('Send'),['class'=>'theme-btn theme-bg','id'=>'send']); ?>
                        
                      <?= $this->Form->end() ?>

                        </div>
                </div>
            </div>
        </div>
      </section> 
    
    
   </section><!--st-content-end-->


<script>
$().ready(function() {
  var cform = $("#contact-form").validate({
    rules: {
      email: {
        required: true,
        email: true
      },
      name: {
        required: true
      },
      subject: {required: true},
      message: {
        required: true
      }
    
    },
    messages: {
      name: "Please enter your name",
      email: "Please enter a valid email address",
      message: "Message is required",
      subject: "Please enter your subject"
    }
  });
        

//    jQuery("#send").click(function(event) {
//           if(cform.form()){  
//           jQuery.ajax({
//                     url: '<?php echo $this->request->webroot ;?>users/capchaverify', 
//                     data: jQuery('#contact-form').serialize(),
//                     type: 'POST',
//                     dataType: "json",
//                     success: function (msg) {    
//                         if (msg.status === true) 
//                         {
//                             jQuery(".mymessage").html(msg.msg); 
//                             jQuery("#contact-form").submit();  
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
   

 
 
});
</script>
