<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Images']
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
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
            'contain' => ['Images', 'Assets', 'UserAddresses', 'UserPackages']
        ]);

        $this->set('user', $user);
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
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $images = $this->Users->Images->find('list', ['limit' => 200]);
        $this->set(compact('user', 'images'));
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
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data=$this->request->getData();
            $user = $this->Users->patchEntity($user,$data );
            if($data['title']=='นาย'){
                $user->gender='M';
            }else{
                $user->gender='F';
            }
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $images = $this->Users->Images->find('list', ['limit' => 200]);
        $this->set(compact('user', 'images'));
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
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
     public function changepassword($id = null) {
        $this->viewBuilder()->setLayout('login');
       
        $id = $this->request->getSession()->read('Auth.User.id');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
             $user = $this->Users->find()
                ->where(['id' => $id])
                ->first();
            
            $this->log($data['userid'],'debug');
            if ((new DefaultPasswordHasher)->check($data['opassword'], $user->password)) {
                $user->password = $data['npassword'];
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The password has been saved.'));
                    return $this->redirect(['controller' => 'home', 'action' => 'index']);
                }
                $this->Flash->error(__('The password could not be saved. Please, try again.'));
            } else {
                $this->Flash->error(__('Invalid Old password, try again'));
                
            }
        }
        $this->set(compact('id'));
    }

    public function blockUser ($id = null) {

        $user = $this->Users->get($id);
        $user->islocked = 'Y';
        $this->Users->save($user);

        return $this->redirect(['action'=>'index']);
    }

    public function unblockUser ($id = null) {

        $user = $this->Users->get($id);
        $user->islocked = 'N';
        $this->Users->save($user);

        return $this->redirect(['action'=>'index']);
    }
}
