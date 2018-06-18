 
   <section class="st-content"> 
   	
    
      <section class="about theme-marg">
      	<div class="container">
        	<div class="top-heading text-center"> 
                   <h2 class="text-white"><?php if($aboutus->title){ echo $aboutus->title; }?></h2>
                    <h4 class="text-white">Simply dummy text of the printing</h4>
             </div>
             <div class="row">
             	<div class="col-12 col-lg-5 mr-auto">
                	<div class="pic">
                    	<div class="img">

                    		<?php if($aboutus->image != ''){ ?>
                            <img src="<?php echo $this->request->webroot; ?>images/staticpages/<?php echo $aboutus->image; ?>" alt="<?php echo $aboutus->title; ?>" style="height: 112px;">
                            <?php }else{ ?>
                            <img src="<?php echo $this->request->webroot; ?>images/about.png" alt="<?php echo $aboutus->title; ?>">
                            <?php } ?>
                        
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                	<div class="about-content">
                     <?php if($aboutus->content){ echo $aboutus->content; }?>
                        
                    </div>
                </div>
             </div>
        </div>
      </section> 
      
      <section class="team grey">
      	<div class="container">
        
        	<div class="top-heading mb-4">
                   <h2 class="text-white">our team</h2>
                    <h4 class="text-white">Simply dummy text of the printing</h4>
             </div>
        
        	<div class="row">
            	<div class="col-sm-9">
                	<div class="about-our">
                    	<h3 class="mb-2">About our company</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    </div>
                </div>
                <div class="col-sm-3">
                	<div class="about-come blk">
                    	<h3>Where does it come from?</h3>
                        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature</p>
                    </div>
                </div>
            </div>
            
            <div class="row">
            	<div class="col-sm-3">
                	<div class="team-member text-center">
                    	<img src="<?php echo $this->request->webroot; ?>images/team.png" />
                        <h4 class="mb-1">ERIC DOWNS</h4>
                        <h5>Creative Director</h5>
                    </div>
                </div>
                
               <div class="col-sm-3">
                	<div class="team-member text-center">
                    	<img src="<?php echo $this->request->webroot; ?>images/team.png" />
                        <h4 class="mb-1">ERIC DOWNS</h4>
                        <h5>Creative Director</h5>
                    </div>
                </div>
                
                <div class="col-sm-3">
                	<div class="team-member text-center">
                    	<img src="<?php echo $this->request->webroot; ?>images/team.png" />
                        <h4 class="mb-1">ERIC DOWNS</h4>
                        <h5>Creative Director</h5>
                    </div>
                </div>
                
                <div class="col-sm-3">
                	<div class="team-member text-center">
                    	<img src="<?php echo $this->request->webroot; ?>images/team.png" />
                        <h4 class="mb-1">ERIC DOWNS</h4>
                        <h5>Creative Director</h5>
                    </div>
                </div>
                
            </div>
            
        </div>
      </section>
    
    
   </section><!--st-content-end-->
