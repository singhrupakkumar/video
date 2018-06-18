<?php
namespace App\Controller;

      include(ROOT.'/vendor/coingate/coingate-php/init.php');     
use App\Controller\AppController;

use Cake\Event\Event; 

use Cake\Routing\Router;

use Cake\Mailer\Email;         

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;

 use CoinGate\CoinGate; 

/**
 * Stores Controller
 *
 * @property \App\Model\Table\StoresTable $Stores
 *
 * @method \App\Model\Entity\Store[] paginate($object = null, array $settings = [])
 */
class PlansController extends AppController
{

      
    public function initialize()
    { 
        parent::initialize();
    
    }
    
    	public function beforeFilter(Event $event) {
 
        parent::beforeFilter($event);



        $this->Auth->allow(['index', 'add','plandetails','checkout','payment','ipn','success']);

        $this->authcontent();
  
    } 
    



    public function plandetails($id = null){

      if(!$id)
         return $this->redirect(['controller'=>'videos','action' => 'index']);

      $changeid = base64_decode($id);

      $plans =  $this->Plans->find('all',['conditions'=>['Plans.id'=>$changeid]]); 
      $plans = $plans->first();

     $this->set(compact('plans'));    
              
    }

    public function checkout(){
         $uid = $this->Auth->user('id');
        if($this->Auth->user('id')){
            
            if($this->request->is('post')){ 
             
            $address = array(
                'name'=> $this->request->data['name'],
                'email'=> $this->request->data['email'],
                'phone'=> $this->request->data['phone'],
                'address'=> $this->request->data['address'],
                'city'=> $this->request->data['city'],
                'state'=> $this->request->data['state'],
                'zip'=> $this->request->data['zip']
                );  
          
            $this->request->session()->write('shippingaddress',$address);
            if($this->request->session()->read('shippingaddress')){
              $res['status'] = true;
              $res['msg'] = 'Shipping address saved';
            }else{
             $res['status'] = false;
              $res['msg'] = 'Try Again';   
            }
             echo json_encode($res);  
             exit; 
            }
           $this->loadModel('Users');
           $user = $this->Users->find('all',['conditions'=>['Users.id'=>$this->Auth->user('id')]]);
           $user = $user->first();
            
        }else{ 
            $this->Flash->error(__('Please login to the website in order to have access to the request.'));  
            return $this->redirect(array('action' => 'cart')); 
        }
        $sesid = $this->request->session()->id(); 
        $user_id = $uid?$uid:0;   
        $cart = $this->displaycart($user_id, $sesid); 
         
        $shippingaddress = $this->request->session()->read('shippingaddress');  
        $this->set('user', $user);
        $this->set('cart', $cart);   
        $this->set('shippingaddress', $shippingaddress); 
    }
    
    public function payment() {
        $this->loadModel('Users');
        $this->loadModel('Usersplans');


        $uid      = $this->Auth->user('id');
        $sesid    = $this->request->session()->id(); 

        $user = $this->Users->find('all',['Users.id'=>$uid]);
        $user = $user->first();
   
        if(!empty($this->Auth->user('id'))){ 

        if ($this->request->is('post')) { 
           
            $planid = $this->request->data['planid']; 
            $plans =  $this->Plans->find('all',['conditions'=>['Plans.id'=>$planid]]); 
            $plans = $plans->first(); 
            $enddate = ''; 
            if($plans->slug=='monthly'){
	        	$date = strtotime("+30 day");
				$enddate =  date('Y-m-d', $date);	        	
            }elseif($plans->slug=='yearly'){
            	   	$date = strtotime("+365 day");
				   $enddate =  date('Y-m-d', $date);	

            }elseif($plans->slug=='bi-annualy'){
	            	$date = strtotime("+730 day");
					$enddate =  date('Y-m-d', $date);
            	
            }

            if($this->request->data['paymentmethod']=='stripe') {
              return $this->redirect(['controller' => 'videos', 'action' => 'stripe/'.$planid]); 
            }elseif($this->request->data['paymentmethod']=='paypal') { 

            $userplan = $this->Usersplans->newEntity();   
            $plandata['user_id'] = $uid;
            $plandata['plan_id'] = $plans->id;
            $plandata['payment_method'] = 'paypal';
            $plandata['start_date'] = date('Y-m-d');
            $plandata['end_date'] = $enddate ;	

            $userplan = $this->Usersplans->patchEntity($userplan, $plandata);  
            $save = $this->Usersplans->save($userplan);  
            $last_id = $save['id'];

               $amt =  $plans->price;     
               $returnUrl = Router::url('/', true)."plans/success?order_id=$last_id";  
               $ipnNotificationUrl = Router::url('/', true)."plans/ipn";
          ///////////////////////////////////////////////payment////////////////////////////////////////////////
                        echo ".<form name=\"_xclick\" action=\"https://www.sandbox.paypal.com/cgi-bin/webscr\" method=\"post\">
                    <input type=\"hidden\" name=\"cmd\" value=\"_xclick\">
                    <input type=\"hidden\" name=\"email\" value=\"rupak-buyer@avainfotech.com\">
                    <input type=\"hidden\" name=\"business\" value=\"rupak1-facilitator@avainfotech.com\">
                    <input type=\"hidden\" name=\"currency_code\" value=\"USD\">
                    <input type=\"hidden\" name=\"custom\" value=\"$last_id\">
                    <input type=\"hidden\" name=\"amount\" value=\"$amt\">
                    <input type=\"hidden\" name=\"return\" value=\"$returnUrl\">
                    <input type=\"hidden\" name=\"notify_url\" value=\"$ipnNotificationUrl\"> 
                    </form>";
//                    exit; 
                        echo "<script>document._xclick.submit();</script>";
              }elseif($this->request->data['paymentmethod']=='bitcoin'){
                              $userplans = $this->Usersplans->newEntity();   

                              $plandata['user_id'] = $uid;
                              $plandata['plan_id'] = $plans->id;
                              $plandata['payment_method'] = 'bitcoin';
                              $plandata['start_date'] = date('Y-m-d');
            				  $plandata['end_date'] = $enddate ;	
                              $userplans = $this->Usersplans->patchEntity($userplans, $plandata);  

                              $save1 = $this->Usersplans->save($userplans);   
                              
                              $last_id = $save1['id'];


                        $returnUrl = Router::url('/', true)."plans/success?order_id=".$last_id;          
                        $post_params = array(
                            'order_id'          => $last_id,
                            'price'             =>  $plans->price,
                            'currency'          => 'EUR',
                            'receive_currency'  => 'EUR',
                            //'callback_url'      => 'http://rakesh.crystalbiltech.com/bitcoin/callback.php',
                            'cancel_url'        => Router::url('/', true),
                            'success_url'       =>  $returnUrl,
                            'title'             =>  $plans->name,
                            'description'       =>  $plans->description
                                   );

                          $order = \CoinGate\Merchant\Order::create($post_params,array(   
                            'environment' => 'sandbox', // sandbox OR live
                            'app_id'      => '1854', 
                            'api_key'     => '84yA1frTGCDgPRi7ZmNkKj', 
                            'api_secret'  => 'pX16urDGOTQqnmM3iw29kvocINghKJsy'
                          ));  

                         if ($order) {
                            

                              $session->write('Payorderid', $order->id); 
                              
                              $order->payment_url;
                              $yourURL=$order->payment_url;
                             // echo  $yourURL;
                              echo ("<script>location.href='$yourURL'</script>");
                              exit; 
                          }   

             }else{ 

                $this->Flash->error(__('Payment Method wrong')); 

                 return $this->redirect(['controller' => 'plans', 'action' => 'plandetails/'.base64_encode($planid)]);     
             }           
            
           }else{
             $this->Flash->error(__('Something is wrong!'));  
              return $this->redirect('/'); 

           }
               
        }else{
           $this->Flash->error(__('Please login first for plan subscription'));  
           return $this->redirect('/');    
        }
       

    }
    
      public function success() {
          
        $uid      = $this->Auth->user('id');    
        $sesid    = $this->request->session()->id(); 
        $user_id = $uid?$uid:0; 

        $this->loadModel('Usersplans');


        $data = $this->Usersplans->find('all', array('contain'=>['Plans','Users'],'conditions' => array('Usersplans.id' => $_GET['order_id'])));     
        $data = $data->first()->toArray(); 
        if($data['payment_method']=='paypal'){
        if(isset($_REQUEST['tx'])){ 
        		$email = new Email('default');   

                   $send = $email->from(['rupak@avainfotech.com' => 'Video'])      
                  ->emailFormat('html')
                  ->template('orderconfirmation')
                  ->cc('rupak@avainfotech.com')
                  ->to('rupak@avainfotech.com')
                  ->subject('Video Subscription Mail!')    
                  ->viewVars(array('order' =>$data))           
                  ->send();   

                $this->Usersplans->updateAll(array(
                    'transaction_id'=> $_REQUEST['tx'],
                    'payment_gateway_price'=> $_REQUEST['amt'],
                    'payment_status'=> 1  
                ),array(
                    'Usersplans.id'=>$_GET['order_id']
                )); 


         }

        }else{






                try {

                    $order = \CoinGate\Merchant\Order::find($this->request->session()->read('Payorderid'));

                //$url ="sdfd/ihn?irsdfs=45546&dfghf";

                    if ($order) {
                        $order = \CoinGate\Merchant\Order::find($this->request->session()->read('Payorderid'));
           
                  if($order->status=='paid'){         
                
                 $email = new Email('default');   

                   $send = $email->from(['rupak@avainfotech.com' => 'Video'])      
                  ->emailFormat('html')
                  ->template('orderconfirmation')
                  ->cc('rupak@avainfotech.com')
                  ->to('rupak@avainfotech.com')
                  ->subject('Video Subscription Mail!')    
                  ->viewVars(array('order' =>$data))            
                  ->send();   

                $this->Usersplans->updateAll(array(
                    'transaction_id'=> $order->id,
                    'payment_gateway_price'=>$data['plan']['price'],
                    'payment_status'=> 1
                ),array(
                    'Usersplans.id'=>$_GET['order_id'] 
                )); 

              }
                        

                    }


                } catch (Exception $e) {

                  echo $e->getMessage(); // BadCredentials Not found App by Access-Key

                }

            




        } 
      
         $this->request->session()->delete('Payorderid');  
        
         $this->set('data',$data);    
      }

  
      public function ipn() {  
        $fc = fopen('ipn_data.txt', 'wb');
        ob_start();
        print_r($_REQUEST);
        $req = 'cmd=' . urlencode('_notify-validate');
        foreach ($_REQUEST as $key => $value) {
            $value = urlencode(stripslashes($value));
            $req .= "&$key=$value";
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.sandbox.paypal.com/cgi-bin/webscr');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: www.developer.paypal.com'));
        $res = curl_exec($ch);
        curl_close($ch);
        if (strcmp($res, "VERIFIED") == 0) {
            $custom_field = $_REQUEST['custom'];
            $payer_email = $_REQUEST['payer_email'];
            $trn_id = $_REQUEST['txn_id'];
            $pay = $_REQUEST['mc_gross'];
            $this->loadModel('Usersplans');
            $this->Usersplans->query("UPDATE `orders` SET  `payment_status` = 1,`transaction_id`='$trn_id', `payment_gateway_price`='$pay' WHERE `id` ='$custom_field';");
            $this->set('smtp_errors', "none");
        } else if (strcmp($res, "INVALID") == 0) { 
            
        } 
        $xt = ob_get_clean();   
        fwrite($fc, $xt);
        fclose($fc);
        exit;
         
    }
   

        
}
