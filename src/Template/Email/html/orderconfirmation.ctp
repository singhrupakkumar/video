<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment Confirmation</title>
</head>

<body>

<table style="margin:0px auto;background:#000;text-align:center;border-radius:4px;color:#fff;" width="500" cellspacing="0" cellpadding="10">
  <tbody>
    <tr style="background:#A70000">
      <td style="text-align:center;padding-top:20px;padding-bottom:20px"><img src="https://rupak.gangtask.com/video/images/logo.png" class="m_-1970240808959427802m_-642518431405956217CToWUd CToWUd" width="150px"></td>
    </tr>
    <tr>
      <td><h2 style="margin-bottom:0">Hi <?php if(isset($order['user']['fname'])){ echo $order['user']['fname']; } ?>,</h2></td>
    </tr>
    <tr>
      <td><p style="margin-bottom:0">You're on board with video! Find your subscription plan on video receipt with details below:</p></td>
    </tr>
    <tr>
      <td>
      <table style="background-color:transparent;margin:0px auto" width="95%" cellpadding="10" border="0" bgcolor="#f2f2f2">
          
           <tbody>
            <tr>
              <td style="padding:10px 5px" align="left">Date of purchase:</td>
              <td style="text-align:right;padding:10px 7px" align="left"><span class="aBn" data-term="goog_322639578" tabindex="0"><span class="aQJ"><?php if(isset($order['start_date'])){ echo  date('d M, Y',strtotime($order['start_date'])) ; } ?></span></span></td> 
            </tr>
            
            <tr>
              <td style="padding:10px 5px" align="left">Subscribed plan:</td>
              <td style="text-align:right;padding:10px 7px" align="left"><?php if(isset($order['plan']['name'])){ echo $order['plan']['name']; } ?>            </td></tr>
            
            <tr>
              <td style="padding:10px 5px" align="left">Day(s) elapsed:</td>
              <td style="text-align:right;padding:10px 7px" align="left"><?php
                                $now = time(); // or your date as well
                                $your_date = strtotime($order['start_date']);
                                $datediff = $now - $your_date;

                                echo round($datediff / (60 * 60 * 24)); ?></td>
            </tr>
            
            <tr>
              <td style="padding:10px 5px" align="left">Day(s) remaining:</td>
              <td style="text-align:right;padding:10px 7px" align="left"><?php
                                $now = time(); // or your date as well
                                $your_date = strtotime($order['end_date']);
                                $datediff =  $your_date - $now ;

                                echo round($datediff / (60 * 60 * 24)); ?>day(s)</td>
            </tr>
            
            <tr>
              <td style="padding:10px 5px" align="left">Next renewal date:</td>
              <td style="text-align:right;padding:10px 7px" align="left"><span class="aBn" data-term="goog_322639579" tabindex="0"><span class="aQJ"><?php echo  date('d M, Y',strtotime($order['end_date'])) ;  ?></span></span></td>
            </tr>
         

          </tbody>
        </table>
       </td>
    </tr>
    <tr>
      <td><h5 style="border-top:1px solid #00000080;width:300px;display:block;margin:auto;padding-top:6px">Issued on behalf of video</h5><span class="HOEnZb"><font color="#888888">
        <p style="margin:0;font-size:13px"></p></font></span></td></tr></tbody></table>

</body>
</html> 





    