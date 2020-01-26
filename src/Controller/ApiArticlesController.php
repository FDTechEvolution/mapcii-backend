<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

/**
 * ApiArticles Controller
 *
 *
 * @method \App\Model\Entity\ApiArticle[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApiArticlesController extends AppController {

    public $Articles = null;
    public $Connection = null;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
        $this->viewBuilder()->setLayout('ajax');

        $this->Articles = TableRegistry::get('Articles');

        $this->Connection = ConnectionManager::get('default');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id = null) {
        if (is_null($id)) {
            $limit = $this->request->getQuery('limit');
            if (!is_null($limit)) {
                $data = $this->Articles->find()
                        ->contain(['Images'])
                        ->limit($limit)
                        ->toArray();
            }
            $data = $this->Articles->find()
                    ->contain(['Images'])
                    ->toArray();
        } else {
            $data = $this->Articles->find()
                    ->contain(['Images'])
                    ->where(['Articles.id' => $id])
                    ->first();
        }
        $json = json_encode($data);
        $this->set(compact('json'));
    }

}
