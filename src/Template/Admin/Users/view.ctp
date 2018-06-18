<section class="content-header">
    <h1>
    Users
     <?= $this->Flash->render() ?> 
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View</li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-12">
         
        
        <div class="box">
  <div class="box-header">
    <h3 class="box-title"><?= h($user->fname) ?></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <table class="table table-condensed">
      <tbody>
        <tr>
          
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <?php if($user->fname){ ?>
        <tr>
          <th><?= __('First Name') ?></th>
          <td><?= h($user->fname) ?></td>
        </tr>
        <?php } ?>

        <?php if($user->lname){ ?>
        <tr>
          <th><?= __('Last Name') ?></th>
          <td><?= h($user->lname) ?></td>
        </tr>
        <?php } ?>
        <?php if($user->email){ ?>
        <tr>
          <th><?= __('Email') ?></th>
          <td><?= h($user->email) ?></td>
        </tr>
        <?php } ?> 
       
        <?php if($user->phone){ ?>
        <tr>
          <th><?= __('Phone') ?></th>
          <td><?= h($user->phone) ?></td>
        </tr>
         <?php } ?> 
        <?php if($user->address){ ?>
        <tr>
          <th><?= __('Address') ?></th>
          <td><?= h($user->address) ?></td>
        </tr>
         <?php } ?> 
        
        
        <?php if($user->dob){ ?>
        <tr>
          <th><?= __('Dob') ?></th>
          <td><?= h($user->dob) ?></td>
        </tr>
        <?php } ?>
        
       <?php if($user->city){ ?>
        <tr>
          <th><?= __('City') ?></th>
          <td><?= h($user->city) ?></td>
        </tr>
         <?php } ?>
        
         <?php if($user->state){ ?>
        <tr>
          <th><?= __('State') ?></th>
          <td><?= h($user->state) ?></td>
        </tr>
         <?php } ?>
        
        
          <?php if($user->zip){ ?>  
        <tr>
          <th><?= __('Zip') ?></th>
          <td><?= h($user->zip) ?></td>
        </tr>
         <?php } ?>
        
        
        <?php if($user->country){ ?>
        <tr>
          <th><?= __('Country') ?></th>
          <td><?= h($user->country) ?></td>
        </tr>
         <?php } ?>
        <?php if($user->image){ ?>
        <tr>
          <th><?= __('Image') ?></th> 
          <td>
            <?php if($user->image != ''){ ?>
            <img src="<?php echo $user->image; ?>" style="width: 190px; margin-bottom: 20px;
            " class="previewHolder"/>
            <?php }else{ ?>
            <img src="<?php echo $this->request->webroot; ?>images/users/noimage.png" style="width: 190px; margin-bottom: 20px;
            " class="previewHolder"/>
            <?php } ?>
          </td>
        </tr>
         <?php } ?>

     
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>

        
        
        
        </div>
    </div>
</section> 
