<?php

namespace App\Controller\Admin;



use App\Controller\AppController;

use Cake\Event\Event;
use Cake\Routing\Router;
use Cake\Core\Configure;

use Cake\Error\Debugger;



/**

 * Users Controller

 *

 * @property \App\Model\Table\UsersTable $Users

 *

 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])

 */

class UsersController extends AppController

{



	public function beforeFilter(Event $event) {

        parent::beforeFilter($event);

        if ($this->request->params['prefix'] == 'admin') {

            $this->viewBuilder()->setLayout('admin'); 
            if($this->Auth->user() && $this->Auth->user('role') !='admin'){
              $this->logout();   
              //  $this->viewBuilder()->setLayout('admin');
            }

        }   

        $this->Auth->allow(['logout','customerplan','paymenthistory']);

        $this->authcontent();

    }



    /**

     * Index method

     *

     * @return \Cake\Http\Response|void

     */

    public function login()

    {

		if($this->Auth->user('role') == 'admin'){

			return $this->redirect(['action' => 'index']);
		}

		$this->viewBuilder()->layout('admin2');

		

		if ($this->request->is('post')) {

			if(!filter_var($this->request->data['username'], FILTER_VALIDATE_EMAIL)===false){

				$this->Auth->config('authenticate', [

					'Form'=>['fields'=>['username'=>'email', 'password'=>'password']]

				]);

				$this->Auth->constructAuthenticate();

				$this->request->data['email']=$this->request->data['username'];

				unset($this->request->data['username']);

			}
			$user = $this->Auth->identify();

			if ($user) {

				$this->Auth->setUser($user);

				

				if($this->Auth->user('role') != 'admin'){

					$this->logout();

					$this->Flash->error(__('Invalid Username or Password, try again'));

				}else{				
                                        return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);    
			   		//return $this->redirect($this->Auth->redirectUrl());

				}	

			}else{

				$this->Flash->error(__('Invalid Username or Password, try again'));

			}

        }
       $this->set('title_for_layout', 'Admin Login'); 
    }

	

	public function index()

    {

		//$users = $this->Users->find('all');		

  		$users = $this->Users->find('all', [
			'order' => ['Users.id' => 'desc']
		]);

		$users = $users->all()->toArray();

		$this->set('users', $users);

		$this->set('_serialize', ['users']);

    }

    public function customerplan(){

        $this->loadModel('Usersplans');

       $userplan = $this->Usersplans->find('all', [
            'order' => ['Usersplans.id' => 'desc'],
            'contain'=>['Users','Plans'],
            'conditions'=>['Usersplans.payment_status'=>1]
        ]);

        $userplan = $userplan->all()->toArray();


        $this->set('userplan', $userplan);

        $this->set('_serialize', ['userplan']);         


    }

    public function planview() {


    }


	public function logout() {

        if ($this->Auth->logout()) {

            return $this->redirect(['action' => 'login']);

        }

    }




	public function paymenthistory(){

	  $this->loadModel('Payments');

	  $payment = $this->Payments->find('all',['conditions'=>['Payments.status'=>1],'contain'=>['Users','Videos'],'order'=>['Payments.id'=>'desc']]);

	  $payment=  $payment->all()->toArray();

      $this->set('payment',$payment);  
	}
	

	/**

     * View method

     *

     * @param string|null $id User id.

     * @return \Cake\Http\Response|void

     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.

     */

    public function view($id = null)

    {
        $user = $this->Users->get($id, [

            'contain' => []  

        ]); 

        $this->set('user', $user);
        $this->set('_serialize', ['user']);

    }



    /**

     * Add method

     *

     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.

     */

    public function add()

    { 

        $user = $this->Users->newEntity();

        if ($this->request->is('post')) { 
                $this->request->data['username'] = $this->request->data['email'];   
		$post = $this->request->getData();
		$post['status'] = 1;

            $user = $this->Users->patchEntity($user, $post);

            if ($this->Users->save($user)) {

                $this->Flash->success(__('The user has been saved.'));



                return $this->redirect(['action' => 'index']);

            }else{

            	$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}	

        }

        $this->set(compact('user'));

        $this->set('_serialize', ['user']);
		
		$this->loadModel('Countries');
		
		$countries = $this->Countries->find()->toArray();
		
		$this->set(compact('countries'));

        $this->set('_serialize', ['countries']);

    }



    /**

     * Edit method

     *

     * @param string|null $id User id.

     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.

     * @throws \Cake\Network\Exception\NotFoundException When record not found.

     */

    public function edit($id = null)

    {

         $baseurl = Router::url('/', true);

        $user = $this->Users->get($id, [

            'contain' => []

        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
			
			$post = $this->request->data;

			if($this->request->data['image']['name'] != ''){
					
				if($user->image != ''){
					unlink(WWW_ROOT.'images/users/'.$user->image);
				}	
			
				$image = $this->request->data['image'];
				$name = time().$image['name'];
				$tmp_name = $image['tmp_name'];
				$upload_path = WWW_ROOT.'images/users/'.$name;
				move_uploaded_file($tmp_name, $upload_path);
				
				$post['image'] = $baseurl."images/users/".$name;
			
			}else{
				unset($this->request->data['image']);
				$post = $this->request->data;
			}


            $user = $this->Users->patchEntity($user, $post);

            if ($this->Users->save($user)) {

                $this->Flash->success(__('The user has been saved.'));



                return $this->redirect(['action' => 'index']);

            }else{

	            $this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
        }

        $this->set(compact('user'));

        $this->set('_serialize', ['user']);
		
		$this->loadModel('Countries');
		
		$countries = $this->Countries->find()->toArray();
		
		$this->set(compact('countries'));

        $this->set('_serialize', ['countries']);

    }



    /**

     * Delete method

     *

     * @param string|null $id User id.

     * @return \Cake\Http\Response|null Redirects to index.

     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.

     */

    public function delete($id = null)

    {
        //$this->request->allowMethod(['post', 'delete']);

        $user = $this->Users->get($id);



        if ($this->Users->delete($user)) {

            $this->Flash->success(__('The user has been deleted.'));


        } else {

            $this->Flash->error(__('The user could not be deleted. Please, try again.'));

        }



        return $this->redirect(['action' => 'index']);

    }
	
	public function changepassword($id = null){
		$user = $this->Users->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->getData());
			
			if ($this->Users->save($user)) {
				$this->Flash->success(__('Your password has been changed'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->success(__('Invalid Password, try again'));
				return $this->redirect(['action' => 'index']);
			}
		}
		
		$this->set(compact('user'));
        $this->set('_serialize', ['user']);
	}
        
        /**
     * 
     * @param type $id
     */
    public function enable($id = null) {
           $user = $this->Users->get($id);
           $post['status'] = 1;
           $user = $this->Users->patchEntity($user, $post);
        if ($this->Users->save($user)) {

            $this->Flash->success(__('Activated successfully.'));

        } else {

            $this->Flash->error(__('Unable to activate.'));

        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * 
     * @param type $id
     */
    public function desable($id = null) {
         $user = $this->Users->get($id);
         $post['status'] = 0;
         $user = $this->Users->patchEntity($user, $post);
        if ($this->Users->save($user)) {

            $this->Flash->success(__('Deactivated successfully.'));

        } else {  

            $this->Flash->error(__('Unable to Deactivated.'));

        }



        return $this->redirect(['action' => 'index']);
    }
    
      
        /**
     * 
     * @param type $id
     */
    public function bonusenable($id = null) { 
           $this->loadModel('Products'); 
           $user = $this->Products->get($id);
           $post['bonus_disable_admin'] = 0;
           $user = $this->Products->patchEntity($user, $post);
        if ($this->Products->save($user)) {

            $this->Flash->success(__('Enable successfully.'));

        } else {

            $this->Flash->error(__('Unable to enable.'));

        } 
        
       return $this->redirect(['action' => 'view/'.$user['user_id']]);   
    }

    /**
     * 
     * @param type $id
     */
    public function bonusdisable($id = null) {
        $this->loadModel('Products'); 
         $user = $this->Products->get($id);
         $post['bonus_disable_admin'] = 1;
         $user = $this->Products->patchEntity($user, $post);
        if ($this->Products->save($user)) {

            $this->Flash->success(__('Disable successfully.'));

        } else {  

            $this->Flash->error(__('Unable to Disable.'));

        }
        return $this->redirect(['action' => 'view/'.$user['user_id']]);  
    }


}

