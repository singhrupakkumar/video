<section class="content-header">
    <h1>
    Payment History  
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Payment History</li>
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
                  <th>Sr no.</th>
                  <th>User Name</th>
                  <th>Video Name</th>
                  <th>Pay Amount</th>
                  <th>Pay By</th>
   
                  
                </tr>
                </thead>
                <tbody>
                <?php 

                  $i = 0;
                foreach($payment as $user):

                  $i++; 
                 ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $user['user']['fname']." ".$user['user']['lname']; ?></td>  
                  <td><?php echo $user['video']['name']; ?></td>
                  <td><?php echo $user['video']['price']; ?></td>  
                  <td><?php echo $user['payment_method']; ?></td>
               
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