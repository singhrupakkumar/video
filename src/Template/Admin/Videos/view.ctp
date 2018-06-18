<section class="content-header">
    <h1>
    Product
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
    <h3 class="box-title"><?= h($product->name) ?></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <table class="table table-condensed">
      <tbody>
  
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($product->name) ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?=  $this->Number->format($product->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= h($product->category->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Size') ?></th> 
            <td><?= h($product->length) ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('Time Duration') ?></th> 
            <td><?php if(!empty($product->time_duration)) { echo  date_format($product->time_duration,"H:i:s") ; } ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('Type') ?></th> 
            <td><?= h($product->type) ?></td>
        </tr>
        
         <tr>
            <th scope="row"><?= __('Director') ?></th> 
            <td><?= h($product->director) ?></td>
        </tr>
      
         <tr>
            <th scope="row"><?= __('Price') ?></th> 
            <td>$<?= h($product->price) ?></td>
        </tr>
       
        
 
    
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($product->created) ?></td>
        </tr>
     
        <tr>
          <th><?= __('Poster') ?></th>
          <td>
            <?php if($product->poster != ''){ ?>
            <img src="<?php echo $this->request->webroot; ?>images/videos/<?php echo $product->poster; ?>" style="width: 190px; margin-bottom: 20px;
            " class="previewHolder"/>
            <?php }else{ ?>
            <img src="<?php echo $this->request->webroot; ?>images/videos/no-image.jpg" style="width: 190px; margin-bottom: 20px;
            " class="previewHolder"/>
            <?php } ?>
          </td>
        </tr>

        <tr>
          <th><?= __('Video') ?></th>
          <td>
            <?php if($product->video != ''){ ?>
           <video width="500" controls>
            <source src="<?php echo $product->video ;?>" type="video/mp4">
            <source src="<?php echo $product->video ;?>" type="video/ogg">
            Your browser does not support HTML5 video.
          </video>
            <?php }else{ ?>
            <img src="<?php echo $this->request->webroot; ?>images/videos/no-image.jpg" style="width: 190px; margin-bottom: 20px;
            " class="previewHolder"/>
            <?php } ?>
          </td>
        </tr>
  
      </tbody>  
    </table>
  </div>
  <!-- /.box-body -->
</div>

        
        
        
        </div>
    </div>
</section>       