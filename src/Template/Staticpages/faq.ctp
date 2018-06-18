 <section class="st-content">
    
    
      <section class="faq theme-marg">
        <div class="container">
        
            <div class="top-heading pt-0 pb-5 text-center">
                    <h2 class="text-white">FAQ</h2>
                   
                 </div>
        
            <div class="row">
                <div class="col-sm-12">
                    <div id="accordion" class="cust-accordion">

                    <?php
                     if(!empty($faq)){
                    $inc = 0;
                    foreach ($faq as $key => $value) {
                     $inc++ ;   
                     ?>    
                      <div class="card border-0 mb-3">
                        <div class="card-header border-0 grey" id="heading<?php echo $inc; ?>">
                          <h5 class="mb-0">
                            <button class="btn btn-link text-white" data-toggle="collapse" data-target="#collapse<?php echo $inc; ?>" aria-expanded="true" aria-controls="collapseOne">
                              <i class="mr-2" aria-hidden="true"><img src="<?php echo $this->request->webroot; ?>images/ques.png" /></i> <?php echo $value->title; ?>
                            </button>
                          </h5>
                        </div> 
                    
                        <div id="collapse<?php echo $inc; ?>" class="collapse <?php if($inc == 1){ echo "show"; } ?>" aria-labelledby="heading<?php echo $inc; ?>" data-parent="#accordion">
                          <div class="card-body px-0 pb-0">
                           <p class="mb-3"><?php echo $value->content; ?></p>
                          </div>
                        </div>
                      </div><!--card-->

                     <?php } } ?> 

                    </div>
                </div>
            </div>
        </div>
      </section> 
    
    
   </section><!--st-content-end-->
