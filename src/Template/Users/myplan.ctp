  <section class="st-content">
   	
    
      <section class="subscription subscribe-data theme-marg pb-0">
     	
         <div class="container">
         
         	 <div class="planz mb-5">
             	<h3>Subcribed Plan</h3>
         	<p><?php if(isset($userplan['plan']['description'])){ echo $userplan['plan']['description']; } ?></p>
             </div>
         
         	<div class="row">
             <?= $this->Flash->render() ?>
            	<div class="col-lg-3 col-md-12">
                   <div class="sub_inner text-center">
                                <img src="<?php echo $this->request->webroot; ?>images/s2.png">
                                <h3><?php if(isset($userplan['plan']['name'])){ echo $userplan['plan']['name']; } ?></h3>
                                <p><?php if(isset($userplan['plan']['description'])){ echo $userplan['plan']['description']; } ?></p>
                                <h2><span style="color:#7FA1FE;">$</span> 3.99</h2>
                                 
                     </div>
                </div>
                
              <div class="col-lg-5 col-md-12">
               	<div class="grey purchase">
                    	<h3 class="text-light text-center">Subscription</h3>
                        <ul class="renewal p-0 m-0">
                          <li>
                              <h4>Purchased On</h4>
                              <h4 class="text-right text-md-right"><?php if(isset($userplan['start_date'])){ echo  date('d M, Y',strtotime($userplan['start_date'])) ; } ?></h4>
                          </li>
                          <li>
                              <h4>Subcription Plan</h4>
                              <h4 class="text-right text-md-right"><?php if(isset($userplan['plan']['name'])){ echo $userplan['plan']['name']; } ?></h4>
                          </li>
                           <li>
                              <h4>Total Ammount Paid</h4>
                              <h4 class="text-right text-md-right">$<?php if(isset($userplan['plan']['price'])){ echo $userplan['plan']['price']; } ?></h4>
                          </li>
                          <li>
                              <h4>Days Elapsed</h4>
                              <h4 class="text-right text-md-right"><?php
                                $now = time(); // or your date as well
                                $your_date = strtotime($userplan['start_date']);
                                $datediff = $now - $your_date;

                                echo round($datediff / (60 * 60 * 24)); ?></h4>
                          </li>
                           <li>
                              <h4>Days Remaining</h4>
                              <h4 class="text-right text-md-right"><?php
                                $now = time(); // or your date as well
                                $your_date = strtotime($userplan['end_date']);
                                $datediff =  $your_date - $now ;

                                echo round($datediff / (60 * 60 * 24)); ?></h4>
                          </li>
                          <li>
                              <h4>Next Renewal Date</h4>
                              <h4 class="text-right text-md-right"><?php echo  date('d M, Y',strtotime($userplan['end_date'])) ;  ?></h4>
                          </li>
                  		</ul>
                  </div>
                  
                </div>
                
                <div class="col-lg-4 col-md-12">
                	<div class="planz">
                        <h3>Subcription cancellation terms and conditions</h3>
                        <p>
                        Contrary to popular belief, Lorem Ipsum is not simply random
                        text. It has roots in a piece of classical Latin literature from 45
                        BC, making it over 2000 years old. Richard McClintock, a Latin
                        professor at Hampden-Sydney College in Virginia, looked up
                        one of the more obscure Latin words, consectetur, from a
                        Lorem Ipsum passage, and going through the cites of the
                        word in classical literature, discovered the undoubtable
                        source. Lorem Ipsum comes
                        </p>
                        <button class="theme-btn theme-bg">Cancel Subcriptions</button>
                    </div>
                </div>
                
            </div>
         </div>
         
      </section>
      
      <section class="latest">
        	<div class="container">
            	<div class="top-heading without">
                   <h2 class="text-white">VIDEOS</h2>
                    <h4 class="text-white">Live and subscription video solutions tailored for you</h4>
                 </div>
            			<div class="row">

                            <div class="col-sm-4 col-md-3">
                                <div class="latest-inner">
                                        
                                    <img class="video" src="/video/images/videos/1525088404download (1).jpeg">
                                                                       
                                     <a class="link" href="/video/videos/view/fdfg"><span><img src="/video/images/play.png"></span></a>
                                    <div class="data py-3 px-3">
                                        <h3 class="mb-0">fdfg </h3>
                                        <h5 class="mb-0">WATCH ON OUR VIDEOS</h5>
                                        <span>Price : $22</span>
                                        <a href="/video/videos/paynow/MTI=" class="theme-btn theme-bg mx-auto">Pay Now</a>
                                    </div>
                                   <a href="/video/videos/view/fdfg"> <div class="overlay"></div></a>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-3">
                                <div class="latest-inner">
                                        
                                    <img class="video" src="/video/images/videos/1523012734dracula.jpg">
                                                                       
                                     <a class="link" href="/video/videos/view/dracula1"><span><img src="/video/images/play.png"></span></a>
                                    <div class="data py-3 px-3">
                                        <h3 class="mb-0">Dracula part1 </h3>
                                        <h5 class="mb-0">WATCH ON OUR VIDEOS</h5>
                                        <span>Price : $75</span>
                                        <a href="/video/videos/paynow/Nw==" class="theme-btn theme-bg mx-auto">Pay Now</a>
                                    </div>
                                   <a href="/video/videos/view/dracula1"> <div class="overlay"></div></a>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-3">
                                <div class="latest-inner">
                                        
                                    <img class="video" src="/video/images/videos/1524225725v6.png">
                                                                       
                                     <a class="link" href="/video/videos/view/sferf"><span><img src="/video/images/play.png"></span></a>
                                    <div class="data py-3 px-3">
                                        <h3 class="mb-0">sferf </h3>
                                        <h5 class="mb-0">WATCH ON OUR VIDEOS</h5>
                                        <span>Price : $5252</span>
                                        <a href="/video/videos/paynow/Ng==" class="theme-btn theme-bg mx-auto">Pay Now</a>
                                    </div>
                                   <a href="/video/videos/view/sferf"> <div class="overlay"></div></a>
                                </div>
                            </div>
                           <div class="col-sm-4 col-md-3">
                                <div class="latest-inner">
                                        
                                    <img class="video" src="/video/images/videos/1523609634the-conjuringghost-mos_061016043337.jpeg">
                                                                       
                                     <a class="link" href="/video/videos/view/thedefilerscene666"><span><img src="/video/images/play.png"></span></a>
                                    <div class="data py-3 px-3">
                                        <h3 class="mb-0">The Defiler Scene 666 </h3>
                                        <h5 class="mb-0">WATCH ON OUR VIDEOS</h5>
                                        <span>Price : $50</span>
                                        <a href="/video/videos/paynow/NQ==" class="theme-btn theme-bg mx-auto">Pay Now</a>
                                    </div>
                                   <a href="/video/videos/view/thedefilerscene666"> <div class="overlay"></div></a>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--latest-end-->
    
    
   </section><!--st-content-end-->