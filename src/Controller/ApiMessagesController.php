<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Messages Controller
 *
 * @property \App\Model\Table\MessagesTable $Messages
 *
 * @method \App\Model\Entity\Message[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApiMessagesController extends AppController {

    public $Messages = null;
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
        $this->viewBuilder()->setLayout('ajax');
        $this->Messages = TableRegistry::get('Messages');
    }

    public function index() {
        $this->paginate = [
            'contain' => ['Assets']
        ];
        $messages = $this->paginate($this->Messages);

        $this->set(compact('messages'));
    }

    /**
     * View method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $message = $this->Messages->get($id, [
            'contain' => ['Assets']
        ]);

        $this->set('message', $message);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function create() {
        $data = ['message' => '', 'status' => 400, 'message' => null];
        $message = $this->Messages->newEntity();
        if ($this->request->is('post')) {
            $postData = $this->request->getData();
            $message = $this->Messages->patchEntity($message, $postData);
            if ($this->Messages->save($message)) {
                $data['status'] = 200;
                $data['message'] = $message;
            } else {
                $data['message'] = $message->errors();
            }
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $message = $this->Messages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $message = $this->Messages->patchEntity($message, $this->request->getData());
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('The message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The message could not be saved. Please, try again.'));
        }
        $assets = $this->Messages->Assets->find('list', ['limit' => 200]);
        $this->set(compact('message', 'assets'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $message = $this->Messages->get($id);
        if ($this->Messages->delete($message)) {
            $this->Flash->success(__('The message has been deleted.'));
        } else {
            $this->Flash->error(__('The message could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
