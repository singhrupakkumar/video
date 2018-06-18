 <section class="st-content">
   	
    <section class="vdo theme-marg moviez">
    	
    	<section class="latest">
        	<div class="container">
            	<div class="top-heading py-5 without">
                   <h2 class="text-white">Series</h2>
                   <h4 class="text-white">Live and subscription video solutions tailored for you</h4>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">SORT BY</label>
                      </div>
                     <form method="post" name="filterform" onchange="submit()">
                      <select class="custom-select" name="sortby" id="inputGroupSelect01">
                        <option selected>Select one</option>
                        <option value="new">Just Released</option>
                        <option value="rating">Most rated</option> 
                        <option value="alpha_asc">A-Z</option>
                        <option value="alpha_desc">Z-A</option>
                        
                      </select> 
                    </form>
                    </div>
                 </div>
            			<div class="row">



                            <?php if(!empty($series)) {

                               foreach ($series as $key => $value) {
                                 
                             ?>
                            <div class="col-sm-4 col-md-3">
                                <div class="latest-inner">
                                   <?php if(isset($value->poster)){  ?>    
                                    <img class="video" src="<?php echo $this->request->webroot."images/videos/".$value->poster; ?>">
                                    <?php }else{  ?>
                                    <img class="video" src="<?php echo $this->request->webroot."images/videos/no-image.jpg"?>">
                                    <?php } ?>
                                     <a class="link" href="<?php if(isset($value->name)){ echo $this->request->webroot."videos/view/".$value->slug; } ?>"><span><img src="<?php echo $this->request->webroot ;?>images/play.png" /></span></a>
                                    <div class="data py-2 px-3">
                                        <h3 class="mb-0"><?php if(isset($value->name)){ echo $value->name; } ?></h3>
                                        <h5 class="mb-0">WATCH ON OUR VIDEOS</h5>
                                    </div>
                                   <a href="<?php if(isset($value->name)){ echo $this->request->webroot."videos/view/".$value->slug; } ?>"> <div class="overlay"></div></a>
                                </div>
                            </div>
                           <?php } } ?> 
                            
                           
                   
                </div>
            </div>
        </section><!--latest-end-->

     </section><!--vdo-->
    
  </section><!--st-content-end-->