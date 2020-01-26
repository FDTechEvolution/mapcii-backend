<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * EmailSettings Controller
 *
 * @property \App\Model\Table\EmailSettingsTable $EmailSettings
 *
 * @method \App\Model\Entity\EmailSetting[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmailSettingsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $emailSettings = $this->EmailSettings->find()
                ->first();
        if ($emailSettings == '') {
            $emailSetting = $this->EmailSettings->newEntity();
        }else{
            $emailSetting = $this->EmailSettings->find()
                ->first();
        }
      //  $this->log($emailSettings,'debug');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
           
            $emailSetting = $this->EmailSettings->patchEntity($emailSetting, $data);
             
            if ($this->EmailSettings->save($emailSetting)) {
                $this->Flash->success(__('The email setting has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email setting could not be saved. Please, try again.'));
        }


        $this->set(compact('emailSettings'));
    }

    /**
     * View method
     *
     * @param string|null $id Email Setting id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $emailSetting = $this->EmailSettings->get($id, [
            'contain' => []
        ]);

        $this->set('emailSetting', $emailSetting);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $emailSetting = $this->EmailSettings->newEntity();
        if ($this->request->is('post')) {
            $emailSetting = $this->EmailSettings->patchEntity($emailSetting, $this->request->getData());
            if ($this->EmailSettings->save($emailSetting)) {
                $this->Flash->success(__('The email setting has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email setting could not be saved. Please, try again.'));
        }
        $this->set(compact('emailSetting'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Email Setting id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $emailSetting = $this->EmailSettings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $emailSetting = $this->EmailSettings->patchEntity($emailSetting, $this->request->getData());
            if ($this->EmailSettings->save($emailSetting)) {
                $this->Flash->success(__('The email setting has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email setting could not be saved. Please, try again.'));
        }
        $this->set(compact('emailSetting'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Email Setting id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $emailSetting = $this->EmailSettings->get($id);
        if ($this->EmailSettings->delete($emailSetting)) {
            $this->Flash->success(__('The email setting has been deleted.'));
        } else {
            $this->Flash->error(__('The email setting could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function sendemail() {

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $msg = $data['message'];
            $this->set(compact('msg'));
            $this->set('_serialize', ['msg']);
            $sending = $this->Sendemail->testsend($data['to'], $data['title'], $data['message']);
            if ($sending) {
                $this->Flash->success(__('The email  has been sended.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The email could not be sended. Please, try again.'));
            }
        }
    }

}
