<section class="content-header">
    <h1>
    Customer plan 
    <small></small>  
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Customer plan</li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-12">
        
        <?php echo $this->Flash->render(); ?>
        
        <div class="box">

            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Sr no</th>
                  <th>Plan Name</th>
                  <th>Price</th>
                  <th>User Name</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Pay by</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                   $i = 0; 
                 foreach($userplan as $plan): 
                  $i++;
                  ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $plan['plan']['name']; ?></td> 
                  <td>$<?php echo $plan['plan']['price']; ?></td>  
                  <td><?php echo $plan['user']['fname']." ".$plan['user']['lname']; ?></td>
                  <td><?php echo $plan['start_date']; ?></td>
                  <td><?php echo $plan['end_date']; ?></td>
                  <td><?php echo $plan['payment_method']; ?></td>
                   <?= $this->Html->link(
                        '<span class="fa fa-eye"></span><span class="sr-only">' . __('View') . '</span>',
                        ['action' => 'planview', $plan['id']],
                        ['escape' => false, 'title' => __('View'), 'class' => 'btn btn-info btn-xs']
                    ) ?>
                
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