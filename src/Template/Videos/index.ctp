    <section class="banner" style="background: url(<?php if(isset($homepages[7]['value'])){ echo $this->request->webroot."images/staticpages/". $homepages[7]['value']; } ?>);
    height: 613px;
    overflow: hidden;
    display: flex;
    align-items: flex-end;
    justify-content: flex-end;
    background-size: cover;">
        <div class="banner_content">
            <div class="container">
                <div class="row">
                     <?= $this->Flash->render() ?> 
                    <div class="col-sm-7 mr-auto">
                        <div class="banner_inner mb-4">
                            <a href="<?php echo $this->request->webroot."users/add"; ?>" class="theme-btn red"><?php if(isset($homepages[0]['value'])){ echo $homepages[0]['value']; } ?></a>
                            <h1 class="mt-2 text-white"><?php if(isset($homepages[1]['value'])){ echo $homepages[1]['value']; } ?></h1>
                            <h3 class="text-white"><?php if(isset($homepages[2]['value'])){ echo $homepages[2]['value']; } ?></h3>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </section><!--banner-end-->

  <section class="st-content">
   	
    	<section class="latest">
        	<div class="container">
            	<div class="top-heading without">
                   <h2 class="text-white"><?php if(isset($homepages[3]['value'])){ echo $homepages[3]['value']; } ?></h2>
                    <h4 class="text-white"><?php if(isset($homepages[4]['value'])){ echo $homepages[4]['value']; } ?></h4>
                 </div>
            			<div class="row">

                            <?php if(!empty($Videos)){
                               foreach ($Videos as $key => $value) {

                             ?>
                            <div class="col-sm-4 col-md-3">
                                <div class="latest-inner">
                                    <?php if(isset($value->poster)){  ?>    
                                    <img class="video" src="<?php echo $this->request->webroot."images/videos/".$value->poster; ?>">
                                    <?php }else{  ?>
                                    <img class="video" src="<?php echo $this->request->webroot."images/videos/no-image.jpg"?>">
                                    <?php } ?>
                                   
                                     <a class="link" href="<?php if(isset($value->name)){ echo $this->request->webroot."videos/view/".$value->slug; } ?>"><span><img src="<?php echo $this->request->webroot; ?>images/play.png" /></span></a>
                                    <div class="data py-3 px-3">
                                        <h3 class="mb-0"><?php if(isset($value->name)){ echo $value->name; } ?> </h3>
                                        <h5 class="mb-0">WATCH ON OUR VIDEOS</h5>
                                        <span>Price : $<?php if(isset($value->price)){ echo $value->price; } ?></span>
                                        <a href="<?php  echo $this->request->webroot."videos/paynow/".base64_encode($value->id); ?>" class="theme-btn theme-bg mx-auto">Pay Now</a>
                                    </div>
                                   <a href="<?php if(isset($value->name)){ echo $this->request->webroot."videos/view/".$value->slug; } ?>"> <div class="overlay"></div></a>
                                </div>
                            </div>
                            <?php 

                            } }
                             ?>

                   
                </div>
            </div>
        </section><!--latest-end-->
        
        <section class="products pd">
        	<div class="container">
            	<div class="top-heading pt-0 text-center">
                   	<h2 class="text-white"><?php if(isset($homepages[5]['value'])){ echo $homepages[5]['value']; } ?></h2>
                    <h4 class="text-white"><?php if(isset($homepages[6]['value'])){ echo $homepages[6]['value']; } ?></h4>
                 </div>
                 
            	<div class="row">
                
                	<div class="col-md-10 mx-auto col-sm-12">
                    	<div class="row">
                        	<div class="col-sm-4 px-md-0">
                    	<div class="inner-product">
                        	<img src="<?php echo $this->request->webroot; ?>images/p1.png" />
                            <div class="content px-5 py-5">
                            	<h3 class="mb-3 text-white">LIVE PAY-PER-VIEW</h3>
                                <p class="mb-4">Set up an online PPV event and
                                start pre-booking today</p>
                                <?php if($loggeduser){ ?> 
                                <a href="<?php echo $this->request->webroot;?>categories/collections" class="theme-btn green">VIEW COLLECTIONS</a>
                                <?php }else{ ?>
                                <a href="<?php echo $this->request->webroot;?>users/login" class="theme-btn green">VIEW COLLECTIONS</a>
                                <?php } ?>
                            </div>
                            <div class="overlay overlay_a"></div>
                        </div>
                    </div>
                    
                    <div class="col-sm-4 px-md-0">
                    	<div class="inner-product trans">
                        	<img src="<?php echo $this->request->webroot; ?>images/p2.png" /> 
                            <div class="content px-5 py-5">
                            	<h3 class="mb-3 text-white">LIVE PAY-PER-VIEW</h3>
                                <p class="mb-4">Set up an online PPV event and
                                start pre-booking today</p>
                                <a href="<?php echo $this->request->webroot;?>categories/movies" class="theme-btn theme-bg">VIEW MOVIES</a>
                            </div>
                            <div class="overlay overlay_b"></div>
                        </div>
                    </div>
                    
                    <div class="col-sm-4 px-md-0">
                    	<div class="inner-product">
                        	<img src="<?php echo $this->request->webroot; ?>images/p3.png" />
                            <div class="content px-5 py-5">
                            	<h3 class="mb-3 text-white">LIVE PAY-PER-VIEW</h3>
                                <p class="mb-4">Set up an online PPV event and
                                start pre-booking today</p>
                               <a href="<?php echo $this->request->webroot;?>categories/series" class="theme-btn yellow">VIEW SERIES</a>
                            </div>
                            <div class="overlay overlay_c"></div>
                        </div>
                    </div>
                        </div>
                    </div>
                    
                    
                    
                </div><!--row-end-->
            </div>
        </section><!--products-end-->
    
    
    <section class="subscription">
    	<div class="container">
        	<div class="top-heading pt-0 pb-5 text-center">
                   	<h2 class="text-white"><?php if(isset($homepages[8]['value'])){ echo $homepages[8]['value']; } ?></h2>
             </div>
        	<div class="row">
            	<div class="col-md-10 mx-auto col-sm-12">
            		<div class="row">
                    
                            <?php if(!empty($plans)){
                                $i = 0;
								$colorarray = ['','green','purple','theme-bg'];
                               foreach ($plans as $key => $value) {
                                $i++;
                             ?>
                        <div class="col-sm-4">
                            <div class="sub_inner text-center">
                                <img src="<?php echo $this->request->webroot; ?>images/s<?php echo $i; ?>.png" />
                                <h3><?php if(isset($value->name)){  echo $value->name; } ?></h3>
                                <p><?php if(isset($value->description)){  echo $value->description; } ?></p>
                                <h2><span style="color:#2ED3AE;">$</span><?php if(isset($value->price)){  echo $value->price; } ?></h2>
                                 <a href="<?php if($loggeduser){ echo $this->request->webroot."plans/plandetails/".base64_encode($value->id);  }else{ echo $this->request->webroot."users/login"; } ?>" class="theme-btn <?php if(isset($colorarray[$i])){ echo $colorarray[$i];} ?>"><?php if(isset($homepages[9]['value'])){ echo $homepages[9]['value']; } ?></a> 
                          	</div>
                       	</div>
                        <?php 

                            } }
                        ?>
                    
                        
                   </div>
                </div>
            </div>
        </div>
    </section><!--subscription-end-->
    
    <section class="mobile">
    	<div class="parallax-window" data-parallax="scroll" data-image-src="<?php echo $this->request->webroot; ?>images/mobile.png">
            <div class="container">
                <div class="row">
                
                   <div class="col-sm-7">
                   		<div class="mobile-inner">
                        	<h3><?php if(isset($homepages[10]['value'])){ echo $homepages[10]['value']; } ?></h3>
                            <h4><?php if(isset($homepages[11]['value'])){ echo $homepages[11]['value']; } ?></h4>
                        </div>
                        <div class="options">
                        	<div class="left">
                            	<ul class="m-0 p-0">
                                	<li><img src="<?php echo $this->request->webroot; ?>images/m1.png" /><span>Music</span></li>
                                    <li><img src="<?php echo $this->request->webroot; ?>images/m2.png" /><span>Videos</span></li>
                                    <li class="mb-0"><img src="<?php echo $this->request->webroot; ?>images/m3.png" /><span>Photos</span></li>
                                </ul>
                            </div>
                            <div class="right">
                            	<h3 class="mb-0">Roku App</h3>
                                <h4>Enjoy A La Carte TV and stream your 
        favorite live sports, shows, news and more.</h4>
								<button class="theme-btn theme-bg">Roku App</button>
                            </div>
                        </div>
                   </div>
                   
                    <div class="col-sm-5">
                    	<div class="app">
                        	<img src="<?php echo $this->request->webroot; ?>images/app.png" />
                        </div>
                    </div>
                     
                </div> 
            </div>
    </section><!--mobile-end-->
    
   </section><!--st-content-end-->