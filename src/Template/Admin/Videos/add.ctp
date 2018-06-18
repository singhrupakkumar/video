<section class="content-header">
    <h1>
   <?= __('Video') ?>
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?= __('Add Video') ?></li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-8">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?= __('Add Video') ?></h3> 
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create($product, ['id' => 'product-form', 'enctype' => 'multipart/form-data']) ?>
              <div class="box-body">
                <div class="form-group">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <?php echo $this->Form->control('name', ['class' => 'form-control', 'label' => false]); ?>
                </div> 
               
                  <?php echo $this->Form->control('cat_id',['class' => 'form-control','label'=>'Category']);?>
                   <div class="form-group">
                   <label for="exampleInputEmail1">Type</label>
                  <?php echo $this->Form->select('type',['series'=>'SERIES','movies'=>'MOVIES'],['class' => 'form-control']);?>   
                     </div>    
                 
                  <?php echo $this->Form->control('director',['class' => 'form-control']);?>
                  <?php echo $this->Form->control('time_duration',['class' => 'form-control']);?>
                  <?php echo $this->Form->control('price',['class' => 'form-control','min'=>1]);?> 
                   <div class="form-group">
                    <label>Restricted regions name  separate by comma(,)</label>
                   <?php echo $this->Form->control('region_name',['class' => 'form-control','label'=>false]);?> 
                   </div> 

                  <?php echo $this->Form->control('description',['class' => 'form-control']);?> 
                   
                  <?php echo $this->Form->control('poster',['class' => 'form-control','type'=>'file','required']);?>

                   <?php echo $this->Form->control('video',['class' => 'form-control','type'=>'file','accept'=>'video/mp4,video/x-m4v,video/*','required']);?>



               <div class="form-group">
                  <label for="exampleInputEmail1">Feature Video</label>  
                  <div class="input file">
                    <input type="file" name="feature_video[]" id="feature_video" class="form-control" accept="video/mp4,video/x-m4v,video/*" multiple="multiple">
                  </div>
                </div>   
                        
              </div>   

                <div class="form-group">
                 <label for="exampleInputEmail1">Status</label>
              <?php echo $this->Form->select('status', [
                     '1' => 'Active',
                    '0' => 'Deactive'
                ],['label' => 'Status','class' => 'form-control']);
                ?>  
                </div>
                
            
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
              </div>
            <?= $this->Form->end() ?>
          </div>
        </div>
    </div>
</section> 
<style type="text/css">

	.datetime ,select{
		width: auto; 
    border: none;
    border-radius: 0px;
    background: #fff;
    border: 1px solid #ddd;
    padding: 7px 7px !important;
    color: #777 !important;
    font-size: 16px !important;
    box-shadow: none !important;
    margin: 0px;
	}
</style>
<script>
$('#datepicker').datepicker({
  autoclose: true
})
</script>      

