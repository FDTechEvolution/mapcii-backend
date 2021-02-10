<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * ApiVisitorCounters Controller
 *
 *
 * @method \App\Model\Entity\ApiVisitorCounter[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApiVisitorCountersController extends AppController
{
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
        $this->viewBuilder()->setLayout('ajax');

        $this->Visitors = TableRegistry::get('VisitorCounters');
    }

    public function webCounter() {
        if ($this->request->is(['post', 'ajax'])) {
            $postData = $this->request->getData();
            $isType = '';
            switch ($postData['type']) {
                case 'web' :
                    $isType = 'web';
                    break;
                case 'ขายด่วน' :
                    $isType = 'sale';
                    break;
                case 'โครงการใหม่' :
                    $isType = 'new';
                    break;
                case 'มือสอง' :
                    $isType = '2hand';
                    break;
            }
            $isDate = date('Y-m-d');
            $visitor = $this->Visitors->find()->where(['on_date' => $isDate, 'type' => $isType])->first();
            if(sizeof($visitor) > 0) {
                $count = $visitor->today + 1;
                $visitor->today = $count;

                $this->Visitors->save($visitor);
            }else{
                $isVisitor = $this->Visitors->newEntity();
                $isVisitor->type = $isType;
                $isVisitor->today = 1;
                $isVisitor->on_date = $isDate;
                
                $this->Visitors->save($isVisitor);
            }
        }
    }
}
