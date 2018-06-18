<?php
namespace App\Controller\Admin;

//require_once("../vendor/aws/aws-autoloader.php"); 	  
use App\Controller\AppController;

use Cake\Event\Event;
use Cake\Routing\Router;
use Cake\Core\Configure;

use Cake\Error\Debugger; 
use Cake\ORM\TableRegistry;
//use Aws\S3\S3Client; 





/**
 * Videos Controller
 *
 * @property \App\Model\Table\ProductsTable $Videos
 *
 * @method \App\Model\Entity\Product[] paginate($object = null, array $settings = [])
 */
class VideosController extends AppController
{

    	public function beforeFilter(Event $event) {
             parent::beforeFilter($event);

        if ($this->request->params['prefix'] == 'admin') {

            $this->viewBuilder()->setLayout('admin'); 
            if($this->Auth->user() && $this->Auth->user('role') !='admin'){
             $this->Auth->logout();
              //  $this->viewBuilder()->setLayout('admin');
            }

        }

        $this->Auth->allow(['slugify','gallery','add','index','edit','view','featurevideo','deletefeature','addfeaturevideo','plans']); 

        $this->authcontent();
    ini_set('memory_limit', '-1');    

    }
    
    private function slugify($str) { 
                // trim the string
                $str = strtolower(trim($str));
                // replace all non valid characters and spaces with an underscore
                $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                $str = preg_replace('/-+/', "_", $str);
        return $str;
     } 
     
     
    
     	public function import() {
    require_once("../vendor/aws/S3.php");  	    

//       $s3 = S3Client::factory([
//     'credentials  ' => array('key'=>'AKIAJS4CO5RTJCNFEZDA',
//                 'secret'=>'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'),       
//     'region' => 'us-east-2',
//     'version' => 'latest'
// ]);



if ($this->request->is('post'))
    {
    if(!empty($this->request->data['video']['name']))
        {
  
  
            $bucket = 'hospitalbuckaaaaaaa';
    $s3333->putBucket($bucket, $s3333::ACL_PUBLIC_READ);
    $sourcePath = $_FILES['video']['tmp_name'];
    $targetPath = $_FILES['video']['name'];
   $data = $s3333->putObjectFile($sourcePath, $bucket , $targetPath, $s3333::ACL_PUBLIC_READ);

  
  
    
//     try {
//     $s3->putObject([
//         'Bucket' => 'hospitalbuck',
//         'Key'    => 'QEP7aKqxTnO3vx3cHlS/p+LdY3ghrTlfGCdB0bdH',
//         'Body'   => fopen($this->request->data['video']['tmp_name'], 'r'),
//         'ACL'    => 'public-read',
//     ]);
    

    
    
    
//     $result = $s3->putObject(array(
//     'Bucket'     => 'hospitalbuck',
//     'Key'        => $this->request->data['video']['name'], 
//     'SourceFile' => $this->request->data['video']['tmp_name']
// ));
  
    
// } catch (Aws\S3\Exception\S3Exception $e) {
//     echo "There was an error uploading the file.\n";
// }
                    
                    
         }     

    
        






      }
          
     /*	    include(ROOT.'/vendor/php-simple-html-dom-parser-master/Src/Sunra/PhpSimple/HtmlDomParser.php'); 
     		$this->loadModel('Stores');
                $this->loadModel('Categories');
		$user_arr = [];
		if ($this->request->is('post')) {
		 if(!empty($this->request->data['import_csv']['name'])) {  
		$filename = $this->request->data['import_csv']['tmp_name'];

		$handle = fopen($filename, "r");
		$header = fgetcsv($handle);
		
		$return = array(
		'messages' => array(),
		'errors' => array(),
		);
		$i = 1;
		$mydara = array();
		
		while (($row = fgetcsv($handle)) !== FALSE) {
		$i++; /* This is line 38 
		$mydata [] = $row;

		
		}
		

		foreach ($mydata as $row) {
		$data = array();

		if(isset($row[0])){
		 $store = $this->Stores->find('all',['conditions'=>['Stores.name LIKE' => '%' . $row[0] . '%']]);
                 $store = $store->first();
                 if($store){
                    $data['store_id']= $store['id'];
                 }else{
                      $newstore = $this->Stores->newEntity();
                      if(isset($row[12])){  
                      $sdata['url'] = parse_url($row[12])['host'];
                      }
                      $sdata['name'] = $row[0];
                      $sdata['slug'] = $this->slugify($row[0]); 
                      $storen = $this->Stores->patchEntity($newstore, $sdata);
                      $save1  = $this->Stores->save($storen);
                      if($save1) {
                      $data['store_id']= $save1['id'];            
                      }
                 }
                }
                
                if(isset($row[17])){
		 $cat = $this->Categories->find('all',['conditions'=>['Categories.name LIKE' => '%' . $row[17] . '%']]);
                 $cat = $cat->first();
                 if($cat){
                    $data['cat_id']= $cat['id'];
                 }else{
                      $category = $this->Categories->newEntity();
                      $catdata['name'] = $row[17];
                      $catdata['slug'] = $this->slugify($row[17]); 
                      $category = $this->Categories->patchEntity($category, $catdata);
                      $save  = $this->Categories->save($category);
                      if($save) {
                      $data['cat_id']= $save['id'];            
                      }
                 }
                }
                
		if(isset($row[2])){ 
		   $data['link_id']= $row[2];
		}
		if(isset($row[3])){
		   $data['name']= $row[3];
		   $data['slug'] = $this->slugify($row[3]);
		}
		if(isset($row[4])){
		   $data['description']= $row[4];
		}
		
		if(isset($row[5])){
		   $data['keyword']= $row[5];
		}
		
		if(isset($row[10])){ 
                    $dom = $HtmlDomParser::str_get_html($row[10]);
                    if(isset($dom->root->children[1])){
		    $data['image']=  $dom->root->children[1]->attr['src']; 
                    }
		}
		
		if(isset($row[12])){
		   $data['url']= $row[12];
		}
	
	
                $exist = $this->Products->find('all',['conditions'=>['Products.link_id' =>$row[2]]]);
                $existstore = $exist->first();
                if(empty($existstore)){
                    $user = $this->Products->newEntity();
                    $user = $this->Products->patchEntity($user, $data);
                    $sav = $this->Products->save($user);
                }else{

                    $articlesTable = TableRegistry::get('Products');
                    $article = $articlesTable->get($existstore['id']); // Return article with id 12
                    $article->name = $row[3];
                    $article->description = $row[4];
                    $article->keyword = $row[5];
                     if(isset($dom->root->children[1])){
                    $article->image = $dom->root->children[1]->attr['src'];
                     }
                    $article->url = $row[12];
                    $sav = $articlesTable->save($article);   


                }
		}

	
		if (!empty($sav)) {
		$this->Flash->success(__('The Products has been saved.'));
		return $this->redirect(['action' => 'index']);
		} else {
		$this->Flash->error(__('The following Products could not be saved. Please, try again.')); 

                 return $this->redirect(['action' => 'index']);
		}
		}else{
		  	$this->Flash->error(__('Please select csv file.')); 
                         return $this->redirect(['action' => 'index']);  
		} 
		}  */
     		
         } 
     
     
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {  	
        
        

  	$videos = $this->Videos->find('all',[
			'contain' => ['Categories'],
			'order'		=> ['Videos.id' => 'desc']
		]);

	$videos = $videos->all()->toArray();
	
        foreach($videos as &$data){
              if ($data['image'] != '') {
                if (!filter_var($data['image'], FILTER_VALIDATE_URL) === false) {
                    $data['image'] = $data['image'];
                } else {
                    $data['image'] = Router::url('/', true). "images/products/" . $data['image'];
                }  

            } else {
                $data['image'] = Router::url('/', true). "images/products/no-image.jpg";
            } 
        }

        $this->set(compact('videos'));
        $this->set('_serialize', ['videos']);
    }

        public function plans()
    {   
         $this->loadModel('Plans');   
        $plans = $this->Plans->find('all',[
                'order'     => ['Plans.id' => 'desc']
            ]);

    $plans = $plans->all()->toArray();

    $this->set(compact('plans'));
    $this->set('_serialize', ['plans']);
    }

    
    
    public function gallery($id = null){  
        $gallery = $this->Products->get($id, [
            'contain' => ['Categories', 'Users','Galleries']
        ]);

    
        $this->set('gallery', $gallery);
        $this->set('productid', $id);
        $this->set('_serialize', ['gallery']);
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) 
    {
        $product = $this->Videos->get($id, [
            'contain' => ['Categories']
        ]);
        
     

        $this->set('product', $product);
        $this->set('_serialize', ['product']);
    }


    public function featurevideo($id = null){      

        $video = $this->Videos->get($id, [
            'contain' => ['Categories','Featurevideos']
        ]);
        
     

        $this->set('video', $video);
        $this->set('_serialize', ['video']); 

    }


   public function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }





    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
    require_once("../vendor/aws/S3.php");  

        $this->loadModel('Featurevideos');
        $product = $this->Videos->newEntity();
        if ($this->request->is('post')) {
            
                $image = $this->request->data['poster'];
 
	        $name = time().$image['name'];
		$tmp_name = $image['tmp_name'];
		$upload_path = WWW_ROOT.'images/videos/'.$name; 
		move_uploaded_file($tmp_name, $upload_path); 
            $this->request->data['poster'] = $name;      
            $this->request->data['slug'] =$this->slugify($this->request->data['name']);


               /*************video*****************/   
           if(!empty($this->request->data['video']['name']))
        {
  
  
            $bucket = 'hospitalbuckaaaaaaa';
            $s3333->putBucket($bucket, $s3333::ACL_PUBLIC_READ);
            $sourcePath = $_FILES['video']['tmp_name'];
            $targetPath = $_FILES['video']['name'];
           $data = $s3333->putObjectFile($sourcePath, $bucket , $targetPath, $s3333::ACL_PUBLIC_READ);

            $this->request->data['length'] = $this->formatSizeUnits($_FILES['video']['size']);

            $this->request->data['video'] = "https://s3.amazonaws.com/hospitalbuckaaaaaaa/".$targetPath;

          } 






            $product = $this->Videos->patchEntity($product, $this->request->getData());
            $savevideo = $this->Videos->save($product);
            if ($savevideo) {
                $this->Flash->success(__('The videos has been saved.'));


              /*************Feature video*****************/  

            
           if(!empty($this->request->data['feature_video'][0]['name']))
        {

            foreach ($this->request->data['feature_video'] as $key => $value) {

            $feature = $this->Featurevideos->newEntity();  
  
            $bucket = 'hospitalbuckaaaaaaa';
            $s3333->putBucket($bucket, $s3333::ACL_PUBLIC_READ);
            $sourcePath = $value['tmp_name'];
            $targetPath = $value['name'];
            $data = $s3333->putObjectFile($sourcePath, $bucket , $targetPath, $s3333::ACL_PUBLIC_READ);

            $postfeature['size'] = $this->formatSizeUnits($value['size']); 
            $postfeature['video_id'] = $savevideo['id']; 
            $postfeature['fvideo'] = "https://s3.amazonaws.com/hospitalbuckaaaaaaa/".$targetPath;

           $feature = $this->Featurevideos->patchEntity($feature, $postfeature);
           $this->Featurevideos->save($feature); 

             }

          }





                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The videos could not be saved. Please, try again.'));
        }
        $cats = $this->Videos->Categories->find('list', ['limit' => 200]);   
        $this->set(compact('product', 'cats'));  
        $this->set('_serialize', ['product']);  
    }

    
     public function addfeaturevideo($productid = null )
    {
        $this->loadModel('Galleries'); 
        $gallery = $this->Galleries->newEntity();
        if ($this->request->is('post')) {

                if(isset($this->request->data['image'])){
               
                    for($i=0; $i<count($this->request->data['image']);$i++){
                        $fileName = $this->request->data['image'][$i]['name'];
                        $fileName = date('His') . $fileName;
                        $uploadPath = WWW_ROOT.'images/gallery/'.$fileName; 
                        $actual_file[] = $fileName;
                        move_uploaded_file($this->request->data['image'][$i]['tmp_name'], $uploadPath);
                        $post['product_id'] = $productid;
                        $post['image']    = $fileName;
                        $gallery = $this->Galleries->newEntity();                    
                        $gallery = $this->Galleries->patchEntity($gallery,$post);            
                        $this->Galleries->save($gallery);
                    } 
                     $this->Flash->success(__('The gallery has been saved.'));  
                    return $this->redirect(['action' => 'gallery/'.$productid]);
                }   
   
         
        }
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



        $videos = $this->Videos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) { 
            
            	        $post = $this->request->data;

			if($this->request->data['poster']['name'] != ''){ 
					
			 	
			 
				$image = $this->request->data['poster'];
				$name = time().$image['name'];
				$tmp_name = $image['tmp_name'];
				$upload_path = WWW_ROOT.'images/videos/'.$name;
				move_uploaded_file($tmp_name, $upload_path);
				 
				$post['poster'] = $name;
			
			}else{
				unset($this->request->data['poster']);
				$post = $this->request->data;
			}
            $videos = $this->Videos->patchEntity($videos, $post );  
            if ($this->Videos->save($videos)) {
                $this->Flash->success(__('The videos has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The videos could not be saved. Please, try again.'));
        }
        $cats = $this->Videos->Categories->find('list', ['limit' => 200]); 
        $this->set(compact('videos', 'cats'));    
        $this->set('_serialize', ['videos']); 
    }


    
     public function editplans($id = null)
    {
        $this->loadModel('Plans');

        $plans = $this->Plans->get($id, [
            'contain' => []
        ]);
             if ($this->request->is(['patch', 'post', 'put'])) { 
            
                        $post = $this->request->data;

            $plans = $this->Plans->patchEntity($plans, $post );  
            if ($this->Plans->save($plans)) {
                $this->Flash->success(__('The plan has been saved.'));

                return $this->redirect(['action' => 'plans']);
            }
            $this->Flash->error(__('The plan could not be saved. Please, try again.'));
        }
        $this->set(compact('plans'));    
        $this->set('_serialize', ['plans']); 
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
            $this->Flash->success(__('The videos has been deleted.'));
        } else {
            $this->Flash->error(__('The videos could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    

     public function deletefeature($id = null)
    {

        $this->loadModel('Featurevideos');
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Featurevideos->get($id);
        if ($this->Featurevideos->delete($product)) {
            $this->Flash->success(__('The videos has been deleted.'));
        } else {
            $this->Flash->error(__('The videos could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'featurevideo/'.$product['video_id']]);  
    }
    
       public function gallerydelete($id = null)
    {  
           $this->loadModel('Galleries');
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Galleries->get($id);
        if ($this->Galleries->delete($product)) {
            $this->Flash->success(__('Image is deleted successfully'));
        } else { 
            $this->Flash->error(__('The Image could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'gallery/'.$product['product_id']]);   
    }
    
    
}
