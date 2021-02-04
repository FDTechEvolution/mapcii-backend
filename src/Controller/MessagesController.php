<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Messages Controller
 *
 * @property \App\Model\Table\MessagesTable $Messages
 *
 * @method \App\Model\Entity\Message[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MessagesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
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
    public function add() {
        $message = $this->Messages->newEntity();
        if ($this->request->is('post')) {
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

    public function review() {
        $this->Users = TableRegistry::get('Users');
        $reviews = $this->Messages->find()
                ->contain(['Assets'])
                ->where(['Messages.status !=' => 'DL', 'Messages.type' => 'review'])
                ->order(['Messages.created' => 'DESC'])
                ->toArray();

        $userreviews = [];
        foreach($reviews as $review):
            $users = $this->Users->find()->where(['id' => $review->from_user])->first();
            array_push($userreviews, $users);
        endforeach;

        $this->set(compact('reviews', 'userreviews'));
    }

    public function unReview() {
        if ($this->request->is('post')) {
            $review = $this->Messages->get($this->request->getData('review_id'));
            $review->status = 'DL';
            if($this->Messages->save($review)) {
                $this->Flash->success(__('The Review has been deleted.'));

                return $this->redirect(['action' => 'review']);
            }
            $this->Flash->error(__('The Review could not be deleted. Please, try again.'));
        }
    }

    public function contact() {
        $this->Users = TableRegistry::get('Users');
        $contacts = $this->Messages->find()
                ->contain(['Assets'])
                ->where(['Messages.status !=' => 'DL', 'Messages.type' => 'contact'])
                ->order(['Messages.created' => 'DESC'])
                ->toArray();

        $usercontacts = [];
        foreach($contacts as $contact):
            $users = $this->Users->find()->where(['id' => $contact->from_user])->first();
            array_push($usercontacts, $users);
        endforeach;

        $this->set(compact('contacts', 'usercontacts'));
    }

    public function unContact() {
        if ($this->request->is('post')) {
            $contact = $this->Messages->get($this->request->getData('contact_id'));
            $contact->status = 'DL';
            if($this->Messages->save($contact)) {
                $this->Flash->success(__('The Contact has been deleted.'));

                return $this->redirect(['action' => 'contact']);
            }
            $this->Flash->error(__('The Contact could not be deleted. Please, try again.'));
        }
    }

    public function contactAnswer() {
        if ($this->request->is('post')) {
            $postData = $this->request->getData();

            $contact = $this->Messages->contain(['Assets'])->get($postData['contact_id']);
            $contact->answer = $postData['contact_ans'];
            $contact->status = 'CO';

            $this->Users = TableRegistry::get('Users');
            $user = $this->Users->find()->where(['id' => $contact->from_user])->first();

            if($this->Messages->save($contact)) {

                if($contact->answer != '') : //send email
                    $htmlEmailMsg = sprintf('<h3>เรึยน คุณ%s</h3><br/>', $user->firstname);
                    $htmlEmailMsg .= '<p>จากคำถามที่คุณได้ถามมาดังนี้ ' . $contact->msg . '</p>';
                    $htmlEmailMsg .= '<p>ทางเราขอตอบกลับข้อความดังกล่าว ดังนี้...' . $contact->answer . '</p>';
                    $htmlEmailMsg .= '<p>อ้างอิงจาก : <a href="https://www.mapcii.com/property/view?id=' . $contact->asset_id . '" target="_blank">' . $contact->asset->name . '</a></p><br/>';
                    $htmlEmailMsg .= '<p><center>จึงตอบกลับมาเพื่อให้ทราบ</center></p>';

                    $sending = $this->Sendemail->testsend($user->email, 'ตอบกลับการสอบถาม - Mapcii', $htmlEmailMsg);
                endif;

                $this->Flash->success(__('The Contact has been answer.'));

                return $this->redirect(['action' => 'contact']);
            }
            $this->Flash->error(__('The Contact could not be answer. Please, try again.'));
        }
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
