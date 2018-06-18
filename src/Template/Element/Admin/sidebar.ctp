<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php if($loggeduser['image'] != ''){ ?>
            <img src="<?php echo $loggeduser['image']; ?>" class="img-circle" />
            <?php }else{ ?>
            <img src="<?php echo $this->request->webroot; ?>images/users/noimage.png" class="img-circle" />
            <?php } ?>
        </div>
        <div class="pull-left info">
          <p><?php if(isset($loggeduser['name'])){ echo $loggeduser['name']; } ?></p> 
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <li class="<?php if($this->request->params['controller'] == 'Dashboard' ) { echo "active"; }?>">
          <a href="<?php echo $this->request->webroot; ?>admin/dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        
        <li class="<?php if($this->request->params['controller'] == 'Users' ) { echo "active"; }?>">
          <a href="<?php echo $this->request->webroot; ?>admin/users">
            <i class="fa fa-user"></i> <span>Users</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
 
        
        <li class="<?php if($this->request->params['controller'] == 'Videos' ) { echo "active"; }?>">
          <a href="<?php echo $this->request->webroot; ?>admin/videos">
            <i class="fa fa-video-camera"></i> <span>Videos</span>  
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        
        <li class="<?php if($this->request->params['controller'] == 'Categories' ) { echo "active"; }?>">
          <a href="<?php echo $this->request->webroot; ?>admin/categories">
            <i class="fa fa-tags"></i> <span>Category</span>  
            <span class="pull-right-container">
            </span>
          </a>
        </li>

         <li class="<?php if($this->request->params['controller'] == 'Videos' ) { echo "active"; }?>">
          <a href="<?php echo $this->request->webroot; ?>admin/videos/plans">
            <i class="fa fa-file"></i> <span>Subscription</span>  
            <span class="pull-right-container">
            </span>
          </a>
        </li>

         <li class="<?php if($this->request->params['controller'] == 'Users' && $this->request->params['action'] == 'customerplan') { echo "active"; }?>">
          <a href="<?php echo $this->request->webroot; ?>admin/users/customerplan">
            <i class="fa fa-file"></i> <span>Customer plan</span>  
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li class="<?php if($this->request->params['controller'] == 'Users' && $this->request->params['action'] == 'paymenthistory') { echo "active"; }?>">
          <a href="<?php echo $this->request->webroot; ?>admin/users/paymenthistory">
            <i class="fa fa-file"></i> <span>Payment History</span>  
            <span class="pull-right-container">
            </span>
          </a>
        </li>
      
        <li class="<?php if($this->request->params['controller'] == 'Staticpages' ) { echo "active"; }?>">
          <a href="<?php echo $this->request->webroot; ?>admin/staticpages">
            <i class="fa fa-file"></i> <span>Pages</span>  
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li class="<?php if($this->request->params['controller'] == 'Staticpages' && $this->request->params['action'] == 'faq') { echo "active"; }?>">
          <a href="<?php echo $this->request->webroot; ?>admin/staticpages/faq">
            <i class="fa fa-question-circle"></i> <span>Faq</span>  
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li class="<?php if($this->request->params['controller'] == 'Contacts' ) { echo "active"; }?>">
          <a href="<?php echo $this->request->webroot; ?>admin/contacts">
            <i class="fa fa-address-card"></i> <span>Contact Us</span>  
            <span class="pull-right-container">  
            </span>
          </a>  
        </li>
        
        <!--li class="<?php if($this->request->params['controller'] == 'Articles' ) { echo "active"; }?>">
          <a href="<?php echo $this->request->webroot; ?>admin/articles">
            <i class="fa fa-pencil-square-o"></i> <span>Articles</span>  
            <span class="pull-right-container">  
            </span>
          </a>  
        </li>
        <li class="<?php if($this->request->params['controller'] == 'Orders' ) { echo "active"; }?>">
          <a href="<?php echo $this->request->webroot; ?>admin/orders">
            <i class="fa fa-first-order"></i> <span>Orders</span>  
            <span class="pull-right-container">    
            </span>
          </a>
        </li>

        
        <li class="<?php if($this->request->params['controller'] == 'Orders' ) { echo "active"; }?>">
          <a href="<?php echo $this->request->webroot; ?>admin/orders/payments">
            <i class="fa fa-money"></i> <span>Payments</span>      
            <span class="pull-right-container">
            </span>
          </a>
        </li-->
        
        <li class="<?php if($this->request->params['controller'] == 'Reviews' ) { echo "active"; }?>">
          <a href="<?php echo $this->request->webroot; ?>admin/reviews">
            <i class="fa fa-comments-o"></i> <span>Reviews</span>        
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class="<?php if($this->request->params['action'] == 'homepage' ) { echo "active"; }?>">
          <a href="<?php echo $this->request->webroot; ?>admin/staticpages/homepage">
            <i class="fa fa-file"></i> <span>Home Page</span>  
            <span class="pull-right-container">
            </span>
          </a>
        </li>    
        <li class="<?php if($this->request->params['controller'] == 'Settings' ) { echo "active"; }?>">
          <a href="<?php echo $this->request->webroot; ?>admin/settings">
            <i class="fa fa-cog"></i> <span>Settings</span>  
            <span class="pull-right-container">
            </span>
          </a>
        </li>
  
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>