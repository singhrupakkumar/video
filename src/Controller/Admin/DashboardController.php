<?php

namespace App\Controller\Admin;



use App\Controller\AppController;

use Cake\Event\Event;

use Cake\Core\Configure;

use Cake\Error\Debugger;



/**

 * Users Controller

 *

 * @property \App\Model\Table\UsersTable $Users

 *

 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])

 */

class DashboardController extends AppController

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

        $this->Auth->allow(['logout']);

        $this->authcontent();

    }



	public function index(){

		$this->loadModel('Users');
		$this->loadModel('Videos');
		$this->loadModel('Usersplans');
		$this->loadModel('Categories');

        $this->loadModel('Reviews');
		$users = $this->Users->find('all',[
			'conditions' => ['Users.role' => 'user','Users.status' => 1]
		])->all()->toArray();
		
		$this->set('users', $users);
		$this->set('_serialize', ['users']);
		
		$videos = $this->Videos->find('all',[ 
			'conditions' => ['Videos.status' => 1]
		])->all()->toArray();
		
		$this->set('videos', $videos);  
		$this->set('_serialize', ['videos']);  

		

		$members = $this->Users->find('all',[
			'conditions' => ['Users.status' => 1],
			'order'		=> ['Users.id' => 'desc'],
			'limit'		=>	8
		])->all()->toArray();
		
		$this->set('members', $members);
		$this->set('_serialize', ['members']);
                
        $reviews = $this->Reviews->find('all',[
                'conditions' => ['Reviews.status' => 1],
		])->all()->toArray();
		
		$this->set('reviews', $reviews);  
		$this->set('_serialize', ['reviews']);


		/*************Top Categories***************/


		$topcategory = $this->Categories->find('all',[
			'conditions' => ['Categories.status' => 1],
			'order'		=> ['Categories.id' => 'desc'],
			'limit'		=>	5
		])->all()->toArray();
		
		$this->set('topcategory', $topcategory);
		$this->set('_serialize', ['topcategory']);


		/*************Latest 5 Subscribed Users***************/


		$topsubscribeduser = $this->Usersplans->find('all',[
			'contain'=>['Users'],
			'conditions' => ['Usersplans.status' => 1],
			'order'		=> ['Usersplans.id' => 'desc'],
			'limit'		=>	5
		])->all()->toArray();

		$this->set('topsubscribeduser', $topsubscribeduser);   
		$this->set('_serialize', ['topsubscribeduser']);
		  

	}
}