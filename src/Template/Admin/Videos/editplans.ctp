<section class="content-header">
    <h1>
   <?= __('Subscription') ?>
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> <?= __('Home') ?></a></li>
        <li class="active"><?= __('Edit Subscription') ?></li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-8">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?= __('Edit Subscription') ?><strong>(ID: <?php echo $plans->id; ?>)</strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create($plans, ['id' => 'plan-form', 'enctype' => 'multipart/form-data']) ?>
              <div class="box-body">
              	<div class="form-group">
  
                <div class="form-group">
                  <?php echo $this->Form->control('name', ['class' => 'form-control', 'label' =>'Name']); ?>
                </div>
                 <?php echo $this->Form->control('price',['class' => 'form-control']);?>


        
                <div class="form-group">
                  <?php echo $this->Form->control('description', ['class' => 'form-control', 'label' => 'Description']); ?>
                </div> 
          
                    
                    
                <div class="form-group">
                  <label for="exampleInputEmail1">Status</label>
                  <select name="status" class="form-control">
                    <option value="1" <?php if($plans->status==1){ echo "selected"; }?>>Active</option>
                    <option value="0" <?php if($plans->status==0){ echo "selected"; }?>>Deactive</option>
        
                  </select>
                </div>   
                
                     
              </div>


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
  