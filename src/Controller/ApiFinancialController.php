<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * ApiFinancial Controller
 *
 *
 * @method \App\Model\Entity\ApiFinancial[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApiFinancialController extends AppController
{

    public $Financials = null;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
        $this->viewBuilder()->setLayout('ajax');

        $this->Financials = TableRegistry::get('financial_accounts');
    }

    public function listfinancials () {
        $data = ['message' => '', 'status' => 400];

        if ($this->request->is(['get', 'ajax'])) {

            $q = $this->Financials->find('all')
                ->order(['created' => 'ASC']);
            $financials = $q->toArray();

            if (sizeof($financials) > 0) {
                $data['status'] = 200;
                $data['financiallist'] = $financials;
            } else {
                $data['message'] = "Financials is empty.";
            }
        } else {
            $data['message'] = "incorrect method.";
        }

        $json = json_encode($data,JSON_PRETTY_PRINT);
        $this->set(compact('json'));
        $this->set('_serialize', 'json');
    }
    
}
