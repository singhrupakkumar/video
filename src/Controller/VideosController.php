<?php
namespace App\Controller;

require_once('../vendor/stripe/stripe-php/init.php');
 include(ROOT.'/vendor/coingate/coingate-php/init.php');    

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Routing\Router;
use Cake\Mailer\Email;
use Cake\Auth\DefaultPasswordHasher;

 use CoinGate\CoinGate;
 //use Monero\Wallet; 
//use \CROSCON\CommissionJunction\Client;      



/**
 * Videos Controller
 *
 * @property \App\Model\Table\VideosTable $Videos
 *
 * @method \App\Model\Entity\Product[] paginate($object = null, array $settings = [])
 */
class VideosController extends AppController
{

    
    public function initialize()
    { 
        parent::initialize();
        $this->loadComponent('Cart');    
    }
    
    
        public function beforeFilter(Event $event) {

        parent::beforeFilter($event);  



        $this->Auth->allow(['add','slugify' ,'gallerydelete','searchjson','clear' ,'search','view',
            'index','addtocart','savereview','stripe','stripeforvideo','addcollections','paynow','success','ipn']);                  

        $this->authcontent();        
    }
    
     private function slugify($str) {   
                // trim the string
                $str = strtolower(trim($str));
                // replace all non valid characters and spaces with an underscore
                $str = preg_replace('/[^a-z0-9-]/', '-', $str);
                $str = preg_replace('/-+/', "-", $str);
        return $str;
     } 
    
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
     {  



// $wallet = new Monero\Wallet();

// $destination1 = (object) [
//     'amount' => '0.01',
//     'address' => '47Vmj6BXSRPax69cVdqVP5APVLkcxxjjXdcP9fJWZdNc5mEpn3fXQY1CFmJDvyUXzj2Fy9XafvUgMbW91ZoqwqmQ6RjbVtp'
// ];

// $options = [
//     'destinations' => $destination1
// ];

// echo $wallet->transfer($options);
// exit;
 

        $this->loadModel('Users');
        $this->loadModel('Plans');
        $this->loadModel('Categories');
        if($this->request->is('post')){
        $uname =  $this->request->data['sellername'];     
        $seller = $this->Users->find('all',['conditions'=>['Users.name LIKE' => '%' . $uname . '%']]); 
        $seller = $seller->first();
        $seller_id = $seller['id'];    
        $this->paginate = [
            'contain' => ['Categories'],
            'conditions'=>['Videos.user_id'=>$seller_id]
        ];  
        
        }else{

        $this->paginate = [
            'contain' => ['Categories'],
            'order'   => ['Videos.id' => 'desc']
        ];
            
        }
        $Videos = $this->paginate($this->Videos); 

        
        $categories = $this->Categories->find('all',[ 'contain' => ['Videos']]); 
        $categories = $categories->all();
        /*****************Plans*********************/
        $plans = $this->Plans->find('all',[ 'contain' => []],['conditions'=>['Plans.status' => 1]]);  
        $plans = $plans->all()->toArray();

        $this->set(compact('Videos','categories','plans')); 
        $this->set('_serialize', ['Videos','categories','plans']);  

       $this->loadModel('Homepages');      
        $homepages = $this->Homepages->find('all');
        $homepages = $homepages->all()->toArray();    
        $this->set(compact('homepages'));
        $this->set('_serialize', ['homepages']);   

    }
 
    
      public function paynow($id = NULL){

       if(!$id)
         return $this->redirect(['controller'=>'videos','action' => 'index']);

      $changeid = base64_decode($id);
      $video =  $this->Videos->find('all',['conditions'=>['Videos.id'=>$changeid]]);

      $video =  $video->first();

      $session = $this->request->session();
      

      $this->loadModel('Users');
      $this->loadModel('Payments');


        $uid      = $this->Auth->user('id');
        $sesid    = $this->request->session()->id(); 

        $user = $this->Users->find('all',['Users.id'=>$uid]);
        $user = $user->first();


        if(!empty($this->Auth->user('id'))){ 

          if ($this->request->is('post')) {

             if($this->request->data['paymentmethod']=='stripe') {
              return $this->redirect(['controller' => 'videos', 'action' => 'stripeforvideo/'.$changeid]); 
            }else if($this->request->data['paymentmethod']=='paypal') { 

            $payment = $this->Payments->newEntity();   
            $paymentdata['user_id'] = $uid;
            $paymentdata['video_id'] = $video->id;
            $paymentdata['payment_method'] = 'paypal';

            $payment = $this->Payments->patchEntity($payment, $paymentdata);  
            $save = $this->Payments->save($payment);  
            $last_id = $save['id'];

               $amt =  $video->price;     
               $returnUrl = Router::url('/', true)."videos/success?order_id=$last_id";  
               $ipnNotificationUrl = Router::url('/', true)."videos/ipn";
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
                        
              }else if($this->request->data['paymentmethod']=='bitcoin') {
                             $payment = $this->Payments->newEntity(); 

                             $paymentdata['user_id'] = $uid;
                              $paymentdata['video_id'] = $video->id;
                              $paymentdata['payment_method'] = 'bitcoin';

                    
                              $payment = $this->Payments->patchEntity($payment, $paymentdata);  

                              $save1 = $this->Payments->save($payment);   
                              
                              $last_id = $save1['id'];


                        $returnUrl = Router::url('/', true)."videos/success?order_id=".$last_id;          
                        $post_params = array(
                            'order_id'          => $last_id,
                            'price'             =>  $video->price,
                            'currency'          => 'EUR',
                            'receive_currency'  => 'EUR',
                            //'callback_url'      => 'http://rakesh.crystalbiltech.com/bitcoin/callback.php',
                            'cancel_url'        => Router::url('/', true),
                            'success_url'       =>  $returnUrl,
                            'title'             =>  $video->name,
                            'description'       =>  $video->description
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
                      
                     }








          }
               
        }else{
           $this->Flash->error(__('Please login first for plan subscription'));  
           return $this->redirect('/');    
        }



       $this->set(compact('video'));
       $this->set('_serialize', ['video']);  

      } 
  
    

     public function success() {
          
        $uid      = $this->Auth->user('id');    
        $sesid    = $this->request->session()->id(); 
        $user_id = $uid?$uid:0; 

        $this->loadModel('Payments');


        $data = $this->Payments->find('all', array('contain'=>['Videos','Users'],'conditions' => array('Payments.id' => $_GET['order_id'])));     
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

                $this->Payments->updateAll(array(
                    'transaction_id'=> $_REQUEST['tx'],
                    'status'=> 1  
                ),array(
                    'Payments.id'=>$_GET['order_id']
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

                $this->Payments->updateAll(array(
                    'transaction_id'=> $order->id, 
                    'status'=> 1
                ),array(
                    'Payments.id'=>$_GET['order_id'] 
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
            $this->loadModel('Payments');
            $this->Payments->query("UPDATE `payments` SET `status` = 1, `transaction_id`='$trn_id' WHERE `id` ='$custom_field';");
            $this->set('smtp_errors', "none");
        } else if (strcmp($res, "INVALID") == 0) {
            
        } 
        $xt = ob_get_clean();   
        fwrite($fc, $xt);
        fclose($fc);  
        exit;
         
    }
    
    
    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $this->loadModel('Users');
        $this->loadModel('Usersplans');
        if(!$this->Auth->user('id')){
          $this->Flash->error(__('You must login first!'));
          return $this->redirect(array('controller' => 'videos', 'action' => 'index'));     
        }else{

        $udata = $this->Users->find('all',['conditions' => ['Users.id'=>$this->Auth->user('id')]]);

        $udata = $udata->first()->toArray();

        $now = time(); // or your date as well
        $your_date = strtotime($udata['created']);
        $datediff = $now - $your_date;

        $freeday = round($datediff / (60 * 60 * 24));

         if($freeday > 7){
           $this->Flash->error(__('Your free trial days expired please perchase plan for continue waching.'));
          return $this->redirect(array('controller' => 'videos', 'action' => 'index'));  

         }else{ 


        $today = date('Y-m-d');

        $userplan = $this->Usersplans->find('all', array('contain'=>array('Users','Plans'),    
                'conditions' => ['AND'=>['Usersplans.user_id'=>$this->Auth->user('id'),'Usersplans.payment_status'=>1,'Usersplans.start_date <= ' =>$today,
      'Usersplans.end_date >= ' => $today]]   
            ));
        $userplan = $userplan->first(); 


        // $paymentDate = date('Y-m-d');
        // $paymentDate=  date('Y-m-d', strtotime($paymentDate));;
        // //echo $paymentDate; // echos today! 
        // $contractDateBegin = date('Y-m-d', strtotime("01/01/2001"));
        // $contractDateEnd = date('Y-m-d', strtotime("01/01/2012"));

        // if (($paymentDate > $contractDateBegin) && ($paymentDate < $contractDateEnd))
        // {
        //   echo "is between";
        // }
        // else
        // {
        //   echo "NO GO!";  
        // }

        if($userplan){
        $video = $this->Videos->find('all', array('contain'=>array('Reviews'=>'Users','Featurevideos'),    
                'conditions' => ['Videos.slug'=>$slug]   
            ));
        $video = $video->first(); 


        $region_name = $video['region_name'];
        $region_name = explode(',', $region_name);
        $yourArray = array_map('strtolower', $region_name);


    $url = json_decode(file_get_contents("http://api.ipinfodb.com/v3/ip-city/?key=ddf95cdf285094ae0fdc8cbaa702b3dba1ee346a429f62d91ffb7b36020b9b19&ip=".$_SERVER['REMOTE_ADDR']."&format=json"));

    $current_region =  strtolower($url->regionName);
         $notview = 0;

        if(in_array($current_region,$yourArray)){

         $notview = 1;
        }else{
         $notview = 0; 
        }

        /**********Related video***************/

       $related = $this->Videos->find('all', array('contain'=>array(),
                'conditions' => ['Videos.cat_id'=>$video->cat_id]   
            ));
        $related = $related->all()->toArray(); 

      }else{

        $this->Flash->error(__('Your subscription has been expired please perchase for continue watching.'));
        return $this->redirect(array('controller' => 'videos', 'action' => 'index'));  

      }  


     }   

   }
   
        $this->set('video', $video);
        $this->set('_serialize', ['video']);

        $this->set('related', $related);
        $this->set('_serialize', ['related']);

        $this->set('notview', $notview);
        $this->set('_serialize', ['notview']);
    }

     public function searchjson() {
        $term = null;
        if(!empty($this->request->query['term'])) {
            $term = $this->request->query['term'];
            $terms = explode(' ', trim($term));
            $terms = array_diff($terms, array(''));
            $conditions = array(
                // 'Brand.active' => 1,
                'Videos.status' => 1
            );
            foreach($terms as $term) {
                $conditions[] = array('Videos.name LIKE' => '%' . $term . '%');
            }
            $Videos = $this->Videos->find('all', array(
                'recursive' => -1,
                'contain' => array(
                    
                ),
                'fields' => array(
                    'Videos.id',
                    'Videos.name',
                    'Videos.poster'
                ),
                'conditions' => $conditions,
                'limit' => 20,
            ));
        }
        
         $Videos = $Videos->all(); 
          $Videos = $Videos->toArray();
        
        echo json_encode($Videos);
        exit;

    }
    
    
    public function search() { 
              
        $search = null;
        if(!empty($this->request->query['search']) || !empty($this->request->data['name']) || !empty($this->request->query['catid'])) {
            $search = empty($this->request->query['search']) ? isset($this->request->data['name']) : $this->request->query['search'];
            $search = preg_replace('/[^a-zA-Z0-9 ]/', '', $search);
            if(isset($search)){
            $terms = explode(' ', trim($search));
            $terms = array_diff($terms, array('')); 
            }  
            $conditions = array(
                'Videos.status' => 1
            );
              
           
            if(!empty($this->request->query['catid'])){
               $conditions = array(
                'Videos.cat_id' => $this->request->query['catid']
            );
            }  
            
           if(!empty($terms)){ 
            foreach($terms as $term) {
                $terms1[] = preg_replace('/[^a-zA-Z0-9]/', '', $term);
                $conditions[] = array('Videos.name LIKE' => '%' . $term . '%');
            }
           }   
            
           
            
 
            $Videos = $this->Videos->find('all', array(  
                'contain' => array(
                    'Reviews'
                ),
                'conditions' => $conditions,
                'limit' => 200,
            ));
 
            
             $Videos = $Videos->all(); 
             $Videos = $Videos->toArray(); 
   
            if(count($Videos) == 1) {
             
                return $this->redirect(array('controller' => 'videos', 'action' => 'view/'.$Videos[0]['slug'])); 
            }
            
         if(!empty($terms1)){
            $terms1 = array_diff($terms1, array(''));
         }
         
       
            $this->set(compact('Videos', 'terms1'));
        }
        $this->set(compact('search'));  

        if ($this->request->is('ajax')) {
            $this->layout = false;
            $this->set('ajax', 1);
        } else {
            $this->set('ajax', 0);
        }

        $this->set('title_for_layout', 'Search');

        $description = 'Search';
        $this->set(compact('description'));

        $keywords = 'search';
        $this->set(compact('keywords'));
    }
    
    
    
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Videos->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Videos->patchEntity($product, $this->request->getData());
            if ($this->Videos->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $cats = $this->Videos->Categories->find('treeList', ['limit' => 200]);   
       // $stores = $this->Videos->Stores->find('list', ['limit' => 200]);
        $this->set(compact('product', 'cats'));
        $this->set('_serialize', ['product']); 
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Galleries');
        if(!empty($this->Auth->user('id'))){
        $product = $this->Videos->get($id, [
            'contain' => ['Galleries']
        ]);
      if($this->Auth->user('id') == $product['user_id']){  
        if ($this->request->is(['patch', 'post', 'put'])) {
      

            if ($this->request->data['image'] != 1) {   
                 

                $image = $this->request->data['image'];
	        $name = time().$image['name'];
		$tmp_name = $image['tmp_name'];
		$upload_path = WWW_ROOT.'images/Videos/'.$name;
		move_uploaded_file($tmp_name, $upload_path);
                $this->request->data['image'] = $name;
               }else {
                    unset($this->request->data['image']);
                }
            $this->request->data['user_id'] = $this->Auth->user('id');    
            $product = $this->Videos->patchEntity($product, $this->request->getData());
            $saveproduct = $this->Videos->save($product);
            if ($saveproduct) {
                
                
                
                if(isset($this->request->data['images'])){
                  if ($this->request->data['images'][0]['name'] != '') {   
                    for($i=0; $i<count($this->request->data['images']);$i++){
                        $fileName = $this->request->data['images'][$i]['name'];
                        $fileName = date('His') . $fileName;
                        $uploadPath = WWW_ROOT.'images/gallery/'.$fileName; 
                        $actual_file[] = $fileName;
                        move_uploaded_file($this->request->data['images'][$i]['tmp_name'], $uploadPath);
                        $post['product_id'] = $saveproduct['id'];
                        $post['image']    = $fileName;
                        $gallery = $this->Galleries->newEntity();                    
                        $gallery = $this->Galleries->patchEntity($gallery,$post);            
                        $this->Galleries->save($gallery);
                    } 
                  }else {
                    unset($this->request->data['images']);
                }    
                }   

                $response['status'] = true;
                $response['msg'] = 'The product has been saved.';
            }else{
                $response['status'] = false; 
                $response['msg'] = 'The product could not be saved. Please, try again.';
            }
            echo json_encode($response);
            exit; 
            

        }
    
     }else{  
          $this->Flash->error(__('You have no access'));  
          return $this->redirect(['controller' => 'stores', 'action' => 'index']);      
      }    
        
        
     }else{  
          $this->Flash->error(__('Please login to the website in order to have access to the request.'));  
          return $this->redirect(['controller' => 'videos', 'action' => 'index']);      
      }   
        $cats = $this->Videos->Categories->find('treeList', ['limit' => 200]); 
       // $stores = $this->Videos->Stores->find('list', ['limit' => 200]);
        $this->set(compact('product', 'cats'));  
        $this->set('_serialize', ['product']);    
    }  

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Videos->get($id);
        if ($this->Videos->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller'=>'users','action' => 'myproduct']);
    }
 
     
      public function stripe($id=null){ 
        $this->loadModel('Plans');
         $this->loadModel('Usersplans');
 
          if(!$id)
         return $this->redirect(['controller'=>'videos','action' => 'index']);
         $uid      = $this->Auth->user('id');
          if(!$uid ){
             
            $this->Flash->error(__('Please login first'));
              return $this->redirect(['controller'=>'videos','action' => 'index']);
          }
      

      $changeid = $id;

      $plans =  $this->Plans->find('all',['conditions'=>['Plans.id'=>$changeid]]); 
      $plans = $plans->first();

         $session = $this->request->session();


        if($this->request->is('post')){  

         $price  = $plans['price'];



          \Stripe\Stripe::setApiKey('sk_test_GAjwHaoK3A0yweCQwq2TNlAq');

          if($session->read('paytoken') ==  $_POST['stripeToken']){

             $this->Flash->error(__('Session expired'));
          }else{ 

            $session->write('paytoken',$_POST['stripeToken']);   


          $charge = \Stripe\Charge::create(['amount' =>  $price*100, 'currency' => 'USD', 'card' => $_POST['stripeToken']]);


          $chargeJson = $charge->jsonSerialize();


          if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1){

            $userplan = $this->Usersplans->newEntity();   
              $enddate = ''; 
            if($plans['slug']=='monthly'){
            $date = strtotime("+30 day");
        $enddate =  date('Y-m-d', $date);           
            }elseif($plans['slug']=='yearly'){
                  $date = strtotime("+365 day");
           $enddate =  date('Y-m-d', $date);  

            }elseif($plans['slug']=='bi-annualy'){
                $date = strtotime("+730 day");
          $enddate =  date('Y-m-d', $date);
              
            }

            $plandata['user_id'] = $uid;
            $plandata['plan_id'] = $plans['id'];
            $plandata['payment_method'] = 'stripe';
            $plandata['start_date'] = date('Y-m-d');
            $plandata['end_date'] = $enddate ;   
            $plandata['payment_status'] = 1 ; 

            $userplan = $this->Usersplans->patchEntity($userplan, $plandata);  
            $save = $this->Usersplans->save($userplan);  

              if(!empty($save)) { 
                    $this->Flash->success(__('Successfully payment done! Thanks for subscription'));
                  return $this->redirect(['controller'=>'users','action' => 'myplan']);
                } else {  
                     $this->Flash->error(__('Unable to payment done. please try again'));

                } 
           

            }else{

              $this->Flash->error(__('Unable to payment done. please try again'));
            } 

          }  

        }
      $this->set(compact('plans'));    
         
    } 
    


    public function stripeforvideo($id = null) {

      $this->loadModel('Payments');
      $this->loadModel('Users');
 
          if(!$id)
         return $this->redirect(['controller'=>'videos','action' => 'index']);
         $uid      = $this->Auth->user('id');
          if(!$uid ){
             
            $this->Flash->error(__('Please login first'));
              return $this->redirect(['controller'=>'videos','action' => 'index']);
          }
      

      $changeid = $id;

      $video =  $this->Videos->find('all',['conditions'=>['Videos.id'=>$changeid]]); 
      $video = $video->first();

         $session = $this->request->session();

        if($this->request->is('post')){  

         $price  = $video['price'];



          \Stripe\Stripe::setApiKey('sk_test_GAjwHaoK3A0yweCQwq2TNlAq');

          if($session->read('paytoken') ==  $_POST['stripeToken']){

             $this->Flash->error(__('Session expired'));
          }else{ 

            $session->write('paytoken',$_POST['stripeToken']);   


          $charge = \Stripe\Charge::create(['amount' =>  $price*100, 'currency' => 'USD', 'card' => $_POST['stripeToken']]);


          $chargeJson = $charge->jsonSerialize();


          if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1){

            $payment = $this->Payments->newEntity();   
            $paymentdata['user_id'] = $uid;
            $paymentdata['video_id'] = $video['id'];
            $paymentdata['payment_method'] = 'stripe';  
            $paymentdata['status'] = 1 ;  

            $payment = $this->Payments->patchEntity($payment, $paymentdata);  
            $save = $this->Payments->save($payment);  

              if(!empty($save)) { 
                    $this->Flash->success(__('Successfully payment done!'));
                  return $this->redirect(['controller'=>'users','action' => 'myplan']);
                } else {  
                     $this->Flash->error(__('Unable to payment done. please try again'));

                } 
           

            }else{

              $this->Flash->error(__('Unable to payment done. please try again'));
            } 

          }  

        }
      $this->set(compact('video'));     


    } 
   
    
    public function currencyconverter() { 
     
     if ($this->request->is(array('post','put'))) {       
        $amount = $this->request->data['amount'];
        $from_Currency = $this->request->data['from_currency'];
        $to_Currency = $this->request->data['to_currency'];
     
        $from_Currency = urlencode($from_Currency);
        $to_Currency = urlencode($to_Currency);
        $get = file_get_contents("https://finance.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency");
        $get = explode("<span class=bld>",$get);
        $get = explode("</span>",$get[1]);
        $converted_currency = preg_replace("/[^0-9\.]/", null, $get[0]);

      
     }  
      echo json_encode($converted_currency);   
        exit;    
    }
    
    
    public function gallerydelete(){
        $this->loadModel('Galleries');
        $this->request->allowMethod(['post', 'delete']);
        if($this->request->is('post')){
            
             $id = $this->request->data['id']; 
             $product = $this->Galleries->get($id);
        if ($this->Galleries->delete($product)) {
            $response['status'] = true;
            $response['msg'] = 'The gallery image has been deleted';
        
        } else {
            $response['status'] = false;
            $response['msg'] = 'The product could not be deleted. Please, try again.';
        
        }    
            
        } 
    echo json_encode($response);
    exit;
        
    }


    

    public function addcollections(){

       $this->loadModel('Collections');
      if ($this->request->is('post')) {   

        $video_id = $this->request->data['video_id'];   
        $post = array();

        if(!empty($this->Auth->user('id'))){
           $uid =  $this->Auth->user('id');
        }else{
           $uid =  0;   
        }  
        $post['user_id'] = $uid ;
        $post['video_id'] = $video_id ;    
        
        
        $collection = $this->Collections->newEntity();
        $cnt = $this->Collections->find('all', array('conditions' => array('AND' => array('Collections.user_id' => $uid, 'Collections.video_id' => $video_id))));
        $cnt = $cnt->first(); 
        if (empty($cnt)) {
             $collection = $this->Collections->patchEntity($collection, $post);
             if ($this->Collections->save($collection)) {

               $this->Flash->success(__('Added successfully to the collections'));  
               return $this->redirect('https://' .$_POST['server']);
             }else{
               $this->Flash->error(__('Something Wrong. Try again!')); 
               return $this->redirect('https://' .$_POST['server']);     
             }
         
        } else {   
           $this->Flash->error(__('You have been already added!')); 
           return $this->redirect('https://' .$_POST['server']);
        }

  } 

     }    
    
    public function savereview(){ 
       $this->loadModel('Reviews');
        if ($this->request->is('post')) {


        $video_id = $this->request->data['video_id'];
        $punctuality =  $this->request->data['punctuality'];
        $text =  $this->request->data['text'];
        
        $post = array();

        if(!empty($this->Auth->user('id'))){
           $uid =  $this->Auth->user('id');
        }else{
           $uid =  0;   
        }  
        $post['user_id'] = $uid ;
        $post['text'] = $text ;
        $post['rating'] = $punctuality ;
        $post['video_id'] = $video_id ;    
        
        
        $review = $this->Reviews->newEntity();
        $cnt = $this->Reviews->find('all', array('conditions' => array('AND' => array('Reviews.user_id' => $uid, 'Reviews.video_id' => $video_id))));
        $cnt = $cnt->first(); 
        if (empty($cnt)) {
             $review = $this->Reviews->patchEntity($review, $post);
             if ($this->Reviews->save($review)) {
                 
                 
                $datacnt = $this->Reviews->find('all', array('conditions' =>array('Reviews.video_id' => $video_id)));
                $datacnt = $datacnt->all()->toArray();
                $sum = 0;
                foreach($datacnt as $datra ){
                  $sum +=  $datra['rating'];
                }
        
                $count = count($datacnt);
                $avg = (int) $sum / (int)$count ; 
                $av_reiew = $avg?$avg:1;
                $this->Videos->updateAll(array('ava_rating' =>$av_reiew),
                 array('Videos.id' => $video_id));   
                 
                 
                 
               $this->Flash->success(__('Thanks for the review/rating.')); 
               return $this->redirect('https://' .$_POST['server']);
             }else{
               $this->Flash->error(__('Something Wrong. Try again!')); 
               return $this->redirect('https://' .$_POST['server']);     
             }
         
        } else {   
           $this->Flash->error(__('You have been already submitted the review')); 
           return $this->redirect('https://' .$_POST['server']);
        }

  }  

    }
     
     
    
} 
