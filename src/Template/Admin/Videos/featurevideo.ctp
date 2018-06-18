<section class="content-header">
  
    <h1>
   Feature Videos  
    <small></small>
    </h1>

    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Videos</li>
    </ol>
    
   
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-12">
        
        <?php echo $this->Flash->render(); ?>
        
        <div class="box">
            <!--<div class="box-header">
              <h3 class="box-title">Hover Data Table</h3>
            </div>-->
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
             <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Video') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Size') ?></th>

                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
            
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
                <tbody>
                  <?php foreach ($video['featurevideos'] as $product): ?>
                    
                    
            <tr>
                <td><?= $this->Number->format($product->id) ?></td>  
             

                    <td>
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
                  </td>
                    <td><?= h($product->size) ?></td> 
             
                <td><?php if($product->status==1){ echo "Active"; }else{ echo "Deactive"; } ?></td> 
                <td class="actions">

                    <?= $this->Form->postLink(__('Delete'), ['action' => 'deletefeature', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id),'class' => 'btn btn-danger btn-xs delt']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
                </tbody>
     
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        
        
        
        </div>    
    </div>
</section>  

<style>

.delt { margin-left:20px;} 


</style>