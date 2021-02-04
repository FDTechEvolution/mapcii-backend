<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 *
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $articles = $this->paginate($this->Articles);

        $this->set(compact('articles'));
    }

    public function articleIndex() {
        $articles = $this->Articles->find()
                    ->contain(['Images', 'Users'])
                    ->where(['Articles.isactive' => 'Y'])
                    ->order(['Articles.created' => 'DESC'])
                    ->toArray();

        $this->set(compact('articles'));
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $article = $this->Articles->get($id, [
            'contain' => []
        ]);

        $this->set('article', $article);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            $postData = $this->request->getData();

            $article = $this->Articles->patchEntity($article, $postData);
            $article->user_id = $this->request->getSession()->read('Auth.User.id');
            $article->title = $postData['topic'];

            if($postData['image_file']['tmp_name'] !=''){
                $this->loadComponent('UploadImage');
                $imageId = $this->UploadImage->upload($postData['image_file'],740,380,'article');
                $article->image_id = $imageId['image_id'];
            }

            $article->isactive = 'Y';
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'article-index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $this->set(compact('article'));
    }

    public function unArticle() {
        if ($this->request->is('post')) {
            $article = $this->Articles->get($this->request->getData('article_id'));
            $article->isactive = 'N';
            if($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been deleted.'));
                return $this->redirect(['action' => 'article-index']);
            }
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit() {
        $postData = $this->request->getData();
        $article = $this->Articles->get($postData['article_id'], [
            'contain' => ['Images']
        ]);
        // $this->log($article,'debug');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article,$postData );
            $article->user_id = $this->request->getSession()->read('Auth.User.id');
            $article->title = $postData['topic'];

            if($postData['image_file']['tmp_name'] !=''){
                $this->loadComponent('UploadImage');
                $imageId = $this->UploadImage->upload($postData['image_file'],740,380,'article');
                //$this->log($imageId,'debug');
                $article->image_id = $imageId['image_id'];
            }
            
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'article-index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $this->set(compact('article'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
