<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event;

use Cake\Routing\Router;

use Cake\Mailer\Email;         

use Cake\Auth\DefaultPasswordHasher;
/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 *
 * @method \App\Model\Entity\Category[] paginate($object = null, array $settings = [])
 */
class CategoriesController extends AppController
{

    
    public function beforeFilter(Event $event) {
 
        parent::beforeFilter($event);



        $this->Auth->allow(['index','movies','series','collections']); 

        $this->authcontent();

    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Products'],
            'limit' => 12
        ]; 
        $categories = $this->paginate($this->Categories);

        $this->set(compact('categories'));
        $this->set('_serialize', ['categories']);
    }

    /**
     * View method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $category = $this->Categories->get($id, [
            'contain' => ['ParentCategories', 'ChildCategories']
        ]);

        $this->set('category', $category);
        $this->set('_serialize', ['category']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $category = $this->Categories->newEntity();
        if ($this->request->is('post')) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $parentCategories = $this->Categories->ParentCategories->find('list', ['limit' => 200]);
        $this->set(compact('category', 'parentCategories'));
        $this->set('_serialize', ['category']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $category = $this->Categories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $parentCategories = $this->Categories->ParentCategories->find('list', ['limit' => 200]);
        $this->set(compact('category', 'parentCategories'));
        $this->set('_serialize', ['category']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $category = $this->Categories->get($id);
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }



    public function series(){

        $this->loadModel('Videos');


             if($this->request->is('post')){ 

        if($this->request->data['sortby']=='new'){
          $series = $this->Videos->find('all', array('contain'=>array(),
                'conditions' => ['Videos.type'=>'series'],
                'order'   => ['Videos.id' => 'desc']    
            ));
        $series = $series->all()->toArray();

        }elseif($this->request->data['sortby']=='rating'){

       $series = $this->Videos->find('all', array('contain'=>array(),
                'conditions' => ['Videos.type'=>'series'],
                'order'   => ['Videos.ava_rating' => 'desc']   
            ));
        $series = $series->all()->toArray();   

        }elseif($this->request->data['sortby']=='alpha_asc'){

       $series = $this->Videos->find('all', array('contain'=>array(),
                'conditions' => ['Videos.type'=>'series'],
                'order'   => ['Videos.name' => 'ASC']   
            ));
        $series = $series->all()->toArray();   

        }elseif($this->request->data['sortby']=='alpha_desc'){

       $series = $this->Videos->find('all', array('contain'=>array(),
                'conditions' => ['Videos.type'=>'series'],
                'order'   => ['Videos.name' => 'DESC']     
            ));
        $series = $series->all()->toArray();   

        }   



      }else{

       $series = $this->Videos->find('all', array('contain'=>array(),
                'conditions' => ['Videos.type'=>'series']   
            ));
        $series = $series->all()->toArray();   

       }   


       $this->set(compact('series'));
       $this->set('_serialize', ['series']);   


    }

    public function movies(){
      $this->loadModel('Videos');
      if($this->request->is('post')){ 

        if($this->request->data['sortby']=='new'){
          $movies = $this->Videos->find('all', array('contain'=>array(),
                'conditions' => ['Videos.type'=>'movies'],
                'order'   => ['Videos.id' => 'desc']    
            ));
        $movies = $movies->all()->toArray();

        }elseif($this->request->data['sortby']=='rating'){

      $movies = $this->Videos->find('all', array('contain'=>array(),
                'conditions' => ['Videos.type'=>'movies'], 
                'order'   => ['Videos.ava_rating' => 'desc']  
            ));
        $movies = $movies->all()->toArray();

        }elseif($this->request->data['sortby']=='alpha_asc'){

      $movies = $this->Videos->find('all', array('contain'=>array(),
                'conditions' => ['Videos.type'=>'movies'], 
                'order'   => ['Videos.name' => 'ASC']  
            ));
        $movies = $movies->all()->toArray();

        }elseif($this->request->data['sortby']=='alpha_desc'){

      $movies = $this->Videos->find('all', array('contain'=>array(),
                'conditions' => ['Videos.type'=>'movies'], 
                'order'   => ['Videos.name' => 'DESC']    
            ));
        $movies = $movies->all()->toArray();

        } 



      }else{
       $movies = $this->Videos->find('all', array('contain'=>array(),
                'conditions' => ['Videos.type'=>'movies']   
            ));
        $movies = $movies->all()->toArray();

       }    
       $this->set(compact('movies'));  
       $this->set('_serialize', ['movies']);   
        
    }

    public function collections(){
      $this->loadModel('Collections');
        if(!empty($this->Auth->user('id'))){
           $uid =  $this->Auth->user('id');
        }else{
           $uid =  0;   
        }  

       $movies = $this->Collections->find('all', array('contain'=>array(),
                'conditions' => ['Collections.user_id'=>$uid]   
            ));
        $movies = $movies->first()->toArray();   
       $this->set(compact('movies'));
       $this->set('_serialize', ['movies']);    
        
    }


    
}
