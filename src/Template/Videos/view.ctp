  <section class="st-content">
    
    <section class="vdo theme-marg">
       <?= $this->Flash->render() ?>

       <?php if($notview == 1){ ?>

         <video width="100%" controls autoplay height="700px">
            <source src="video.webm" type="video/mp4">
            <source src="video.webm" type="video/ogg">  
            Your browser does not support HTML5 video.
          </video>

       <?php }else{ ?>    
      <video width="100%" controls autoplay height="700px">
            <source src="<?php if(isset($video['video'])){ echo $video['video'];} ?>" type="video/mp4">
            <source src="<?php if(isset($video['video'])){ echo $video['video'];} ?>" type="video/ogg">
            Your browser does not support HTML5 video.
      </video>

    
      <section class="latest vidz">
          <div class="container">
              <div class="top-heading py-5 without">
                    <h2 class="text-white">LATEST VIDEOS</h2> 
                    <h4 class="text-white">Live and subscription video solutions tailored for you</h4>

               <?php if(!$loggeduser){ ?>  
               <a class="theme-btn theme-bg" href="<?php echo $this->request->webroot ?>users/login">Add to collections</a>    
               <?php }else{ ?>
                <form action="<?php echo $this->request->webroot;?>videos/addcollections" method="post" class="reviw_froms">    
                     
                  <input type="hidden" name="video_id" value="<?php echo $video['id']; ?>">  
                  <input type="hidden" name="server" value="<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
                         
                  <button type="submit" class="theme-btn theme-bg">Add to collections</button>
                </form>
              <?php } ?>    

             
                    
                    <ul class="p-0 mt-3 mb-0">

                          <?php 
                               $avg = 0;
                                 $avgRating = 0;
                            if(!empty($video['reviews'])){   
                                $reviewcount = count($video['reviews']);  
                              
                             foreach($video['reviews'] as $rt){

                                   $avg += $rt['rating'];

                                    }

                                  $rate1 = $reviewcount?$reviewcount:1;
                                    $avgRating = $avg/$rate1; 
                            }
                            ?>
                                    <?php
                                     $i= round($avgRating);
                                        
                                        for($j=0;$j<$i;$j++){
                                        ?>
                                       <li class="d-inline"><img src="<?php echo $this->request->webroot; ?>images/rate.png" /></li>
                                        
                                 
                                        <?php } for($h=0;$h<5-$i;$h++){?>  
                                         
                                       <li class="d-inline"><img src="<?php echo $this->request->webroot; ?>images/rate2.png" /></li>
                                        <?php 
                                        
                                        }   
                                 ?> 

                        <li class="d-inline"><span class="text-white px-2"><?php if(isset($video['time_duration'])){ echo date_format($video['time_duration'],"H:i:s");} ?> Min</span></li>
                        <li class="d-block d-md-inline"><span class="text-white pl-0">Directed By: <?php if(isset($video['director'])){ echo $video['director'];} ?></span></li>
                    </ul>
                 </div>
                  <div class="row">
                            <div class="col-sm-4 col-md-3">
                                <div class="latest-inner vdeo-inner">
                                    <?php if(isset($video->poster)){  ?>    
                                    <img class="video" src="<?php echo $this->request->webroot."images/videos/".$video->poster; ?>">
                                    <?php }else{  ?>
                                    <img class="video" src="<?php echo $this->request->webroot."images/videos/no-image.jpg"?>">
                                    <?php } ?>
                                    
                                    <div class="overlay"></div>
                                </div>
                            </div>
                            
                        <div class="col-sm-8 col-md-9">
                          <div class="desc">
                              <h3>DESCRIPTION</h3>
                                <p><?php if(isset($video['description'])){ echo $video['description'];} ?>
</p>
                            </div>
                        </div>
                        
                </div><!--row-->
                
                <div class="row mt-3">
                   <?php 
                   if(!empty($video['featurevideos'])){

                   foreach ($video['featurevideos'] as $product): ?>
                    <div class="col-md-4">
                      <div class="latest-inner">
                              <?php if($product->fvideo != ''){ ?>
                               <video width="500" controls>
                                <source src="<?php echo $product->fvideo ;?>" type="video/mp4">
                                <source src="<?php echo $product->fvideo ;?>" type="video/ogg">
                                Your browser does not support HTML5 video.
                              </video>
                                <?php }else{ ?>
                                <img src="<?php echo $this->request->webroot; ?>images/videos/no-image.jpg" style="width: 190px; margin-bottom: 20px;
                                " class="previewHolder"/>
                                <?php } ?> 
                    
                      </div>
                    </div> 
                  <?php endforeach; } ?> 
                    
                </div>
                
            </div>
        </section><!--latest-end-->
        
        <section class="review">
          <div class="container">
              <div class="row">
                  <div class="col-sm-12">
                    
                       <div class="memberz">
                          <h2 class="text-white m-0">MEMBER REVIEWS</h2>
                           <?php if(!$loggeduser){ ?>  
                          <a class="theme-btn theme-bg" style="width:auto;" href="<?php echo $this->request->webroot ?>users/login">Write a review</a>
                           <?php }else{ ?>
                          <button class="theme-btn theme-bg" data-toggle="modal" data-target="#exampleModalCenter">Write a review</button>
                           <?php } ?>
                         </div>

                          <?php 
                            if(!empty($video['reviews'])){   
                                $reviewcount = count($video['reviews']); 

                             foreach($video['reviews'] as $rt){

        

                          ?> 
                    
                         <div class="inner">
                            <h4 class="mb-0 text-white"><?php if(isset($rt['user']['fname'])){ echo $rt['user']['fname']; } ?></h4>
                            <ul class="p-0 m-0">
                                <li class="d-block d-md-inline pr-2"><span class="pl-0"><?php if(isset($rt['created'])){ echo $rt['created']; } ?></span></li>
                               
                                 <?php
                                   $i= $rt['rating'];
                                    
                                    for($j=0;$j<$i;$j++){
                                    ?>
                                   <li class="d-inline"><img src="<?php echo $this->request->webroot; ?>images/rate.png" /></li>
                                    
                             
                                    <?php } for($h=0;$h<5-$i;$h++){?>  
                                     
                                   <li class="d-inline"><img src="<?php echo $this->request->webroot; ?>images/rate2.png" /></li>
                                    <?php 
                                    
                                    }   
                                 ?> 
             
                            </ul>
                            <p><?php if(isset($rt['text'])){ echo $rt['text']; } ?></p>
                        </div>

                        <?php } 
                      }
                        ?>  
                        
                    </div>
                </div>
            </div>
        </section>
        
        <!-- review Modal start-->
            <div class="modal fade rvwmod" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
               
                <div class="modal-content">
                  <div class="modal-header write_box">
                    <h5 class="modal-title" id="exampleModalLongTitle">Write a review
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    </h5>
                    
                  </div>
                 <form action="<?php echo $this->request->webroot;?>videos/savereview" method="post" class="reviw_froms"> 
                  <div class="modal-body">
                  <div class="wrapper rating" id="rating"> 
                      <input type="radio" id="st1" name="punctuality" value="5" />      
                      <label for="st1"></label> 
                      <input type="radio" id="st2" name="punctuality" value="4" /> 
                      <label for="st2"></label>
                      <input type="radio" id="st3" name="punctuality"  value="3"/>
                      <label for="st3"></label>
                      <input type="radio" id="st4" name="punctuality" value="2"/>
                      <label for="st4"></label>
                      <input type="radio" id="st5" name="punctuality" value="1"/>
                      <label for="st5"></label>
                         <input type="hidden" name="ava_rating" value="<?php echo $video['ava_rating']; ?>">   
                          <input type="hidden" name="video_id" value="<?php echo $video['id']; ?>">  
                          <input type="hidden" name="server" value="<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
                         
                    </div>
                    <div class="form-group mb-2">
                       <label for="message-text" class="col-form-label">Message:</label>
                       <textarea class="form-control" name="text" id="message-text" rows="3"></textarea>
                     </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="theme-btn theme-bg">Submit</button>
                  </div>
                 </form> 
                </div>
              </div>
            </div>
            
          <!-- Modal end-->

    
  <section class="slides">
      <div class="container">
          <div class="top-heading py-5 without">
                   <h2 class="text-white">RELATED VIDEOS</h2>
                    <h4 class="text-white">Live and subscription video solutions tailored for you</h4>
                 </div>
          <div class="row">
            <div class="col-md-12">
                  <div class="respons">


                    <?php if(!empty($related)){

                      foreach ($related as $key => $value) {
             
                     ?>


                        <div>
                           
                                <div class="latest-inner">
                                     <?php if(isset($value->poster)){  ?>    
                                    <img class="video" src="<?php echo $this->request->webroot."images/videos/".$value->poster; ?>">
                                    <?php }else{  ?>
                                    <img class="video" src="<?php echo $this->request->webroot."images/videos/no-image.jpg"?>">
                                    <?php } ?>
                                    <a class="link" href="#"><span><img src="<?php echo $this->request->webroot; ?>images/play.png" /></span></a>
                                    <div class="data py-2 px-3">
                                        <h3 class="mb-0"><?php if(isset($value->name)){ echo $value->name; } ?> </h3>
                                        <h5 class="mb-0">WATCH ON OUR VIDEOS</h5>
                                    </div>
                                    <a href="<?php if(isset($value->name)){ echo $this->request->webroot."videos/view/".$value->slug; } ?>"> <div class="overlay"></div></a>
                                </div>
                           
                         </div><!--end-->
                         <?php
                             }
                           }
                          ?>     
                         
                         
                    </div>
                    </div>
            </div>
        </div>
    </section><!--slides-->

    <?php  } ?>
    
        </section><!--vdo-->
    
   </section><!--st-content-end-->



     <script>
      jQuery('.rating input').each(function(){

    jQuery(this).click(function(){
        if(!jQuery(this).hasClass('checked')){
            jQuery(this).addClass('checked');
            jQuery(this).prevAll().addClass('checked');
            var rate = jQuery('#rating .checked').length;
        }else{
            jQuery(this).nextAll().removeClass('checked');
            var rate = jQuery('#rating .checked').length;
        }
       
        jQuery('#ratings1').val(rate); 
    });  
});
  </script> 
    














































