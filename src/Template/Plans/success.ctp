
   <section class="st-content">
    
    
      <section class="change-pass theme-marg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="confirmation-outer">
                        <div class="top">
                            <img width="50px" style="z-index: 9;" src="<?php echo $this->request->webroot ;?>images/checkw.png" />
                            <span class="ml-2">Thank you</span>
                            <div class="overlay"></div>
                        </div>
                        <div class="data">
                       
                          <ul class="list-group mb-3">
                          <h3>Your subscription has been placed successfully</h3>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                              <div>
                                <span>Plan Name</span>
                              </div>
                              <strong><?php if(isset($data['plan']['name'])){ echo $data['plan']['name']; } ?></strong>
                            </li>
                            
                            <li class="list-group-item d-flex justify-content-between">
                              <span>Valid To</span>
                              <strong><?php echo  date('d M, Y',strtotime($data['end_date'])) ;  ?></strong>
                            </li>
                            
                            <li class="list-group-item d-flex justify-content-between">
                              <span>Price (USD)</span>
                              <strong>$<?php if(isset($data['plan']['price'])){ echo $data['plan']['price']; } ?></strong>
                            </li>
                          </ul>                 
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </section> 
    
    
   </section><!--st-content-end-->