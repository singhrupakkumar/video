

<?php $this->Html->addCrumb('Search'); ?>


<section class="st-content">
    
    <section class="vdo theme-marg moviez">
      
      <section class="latest">
          <div class="container">
              <div class="top-heading py-5 without">
                   <h2 class="text-white">Search</h2>

                 <?php if($ajax != 1): ?>
                <?php echo $this->Form->create('Video', array('type' => 'GET')); ?>

                    <div class="col-sm-4 col-sm-offset-4">
                       


                     <div class="search-pg" >
                      <div class="form-group">
                         <?php echo $this->Form->input('search', array('label' => false, 'div' => false, 'class' => 'form-control', 'autocomplete' => 'off', 'value' => $search)); ?>
                       <?php echo $this->Form->button('Search', array('div' => false, 'class' => 'btn btn-sm btn-primary black ')); ?>
                      </div>

                      
                    </div> 
                    </div>


                 <?php echo $this->Form->end(); ?>
                 <?php endif; ?>
                 </div>
                  <div class="row">

                      <?php if(!empty($Videos)):
                        foreach($Videos as $item):
                        ?>
                            <div class="col-sm-4 col-md-3">
                                <div class="latest-inner">
                                      <?php if($item['poster']){ ?>  
                                    <img src="<?php echo $this->request->webroot."images/videos/".$item['poster']; ?>" class="video">
                                     <?php }else{ ?>
                                    <img src="<?php echo $this->request->webroot."images/videos/no-image.jpg"; ?>" class="video">
                                     <?php } ?>
                                 
                                     <a class="link" href="<?php echo $this->request->webroot."videos/view/".$item['slug']; ?>"><span><img src="<?php echo $this->request->webroot; ?>images/play.png" /></span></a>
                                    <div class="data py-2 px-3">
                                        <h3 class="mb-0"><?php if(isset($item['name'])){ echo $item['name']; } ?></h3>
                                        <span> <?php if(isset($item['price'])){ echo $item['price']; } ?></span>
                                        <div class="rating">
                                             <ul>
                                      <?php 
                               $avg = 0;
                               $avgRating = 0; 
                            if(!empty($item['reviews'])){   
                                $reviewcount = count($item['reviews']);  
                                 
                             foreach($item['reviews'] as $rt){

                                   $avg += $rt['rating'];

                                    }

                                  $rate1 = $reviewcount?$reviewcount:1;
                                  $avgRating = (int)$avg/$rate1; 
                            }
                                        
                                     $i= round($avgRating);
                                        
                                        for($j=0;$j<$i;$j++){
                                        ?>
                                      <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        
                                 
                                        <?php } for($h=0;$h<5-$i;$h++){?>  
                                         
                                         <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                        <?php 
                                        
                                        } 
                          ?> 
                            <li>(<?php echo count($item['reviews']); ?>)</li>  
                                    </ul>  

                                        </div>
                                        <h5 class="mb-0">WATCH ON OUR VIDEOS</h5>

                                    </div>
                                    <div class="overlay"></div>
                                </div>
                            </div>


                    <?php endforeach; ?>  

                    <?php else: ?>

                    <?php echo '<div class="col-sm-12"><div class="blankimg"><img src="'.$this->request->webroot.'/img/search-not-found.jpg" class="img-responsive"></div></div>';  ?>  
                 
                    <?php endif;?>     
                            
                          
                </div>
            </div>
        </section><!--latest-end-->

     </section><!--vdo-->
    
  </section><!--st-content-end-->






