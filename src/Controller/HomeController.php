<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\I18n\Date;

/**
 * Home Controller
 *
 *
 * @method \App\Model\Entity\Home[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HomeController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->AssetAds = TableRegistry::get('AssetAds');
        $this->Assets = TableRegistry::get('Assets');
        $this->Users = TableRegistry::get('Users');
        $this->Banners = TableRegistry::get('Banners');
        $this->Articles = TableRegistry::get('Articles');
        $this->Contacts = TableRegistry::get('Contacts');
        $this->Messages = TableRegistry::get('Messages');
    }
   

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
      
    }

    public function dashboard() {
        $dateNow = date('Y-m-d');

        $this->asset_ads_stat($dateNow);

        $this->asset_free_stat($dateNow);

        $this->user_stat($dateNow);

        $this->banner_stat($dateNow);

        $this->article_stat($dateNow);

        $this->contact_stat($dateNow);

        $this->message_stat($dateNow);
    }

    private function asset_ads_stat($dateNow) {
        $data_ads = ['sum' => 0, 'now' => 0];
        $query_ads = $this->AssetAds->find();
        $all_ads = $query_ads->select([
                    'count' => $query_ads->func()->count('*'),
                    'as_date' => 'DATE(created)'
                ])
                ->group('as_date');

        foreach($all_ads as $ads) {
            $data_ads['sum'] += $ads->count;
            if($ads->as_date == $dateNow) $data_ads['now'] = $ads->count;
        }
        $this->set(compact('all_ads', 'data_ads'));
    }

    private function asset_free_stat($dateNow) {
        $data_free = ['sum' => 0, 'now' => 0];
        $query_free = $this->Assets->find();
        $all_free = $query_free->select([
                    'count' => $query_free->func()->count('*'),
                    'as_date' => 'DATE(created)'
                ])
                ->group('as_date');
                
        foreach($all_free as $free) {
            $data_free['sum'] += $free->count;
            if($free->as_date == $dateNow) $data_free['now'] = $free->count;
        }
        $this->set(compact('all_free', 'data_free'));
    }

    private function user_stat($dateNow) {
        $data_user = ['sum' => 0, 'now' => 0];
        $query_user = $this->Users->find();
        $all_users = $query_user->select([
                    'count' => $query_user->func()->count('*'),
                    'as_date' => 'DATE(created)'
                ])
                ->group('as_date');
                
        foreach($all_users as $user) {
            $data_user['sum'] += $user->count;
            if($user->as_date == $dateNow) $data_user['now'] = $user->count;
        }
        $this->set(compact('all_users', 'data_user'));
    }

    private function banner_stat($dateNow) {
        $data_banner_a = ['sum' => 0, 'now' => 0];
        $data_banner_b = ['sum' => 0, 'now' => 0];
        $query_banner_a = $this->Banners->find();
        $query_banner_b = $this->Banners->find();
        $all_banner_a = $query_banner_a->select([
                        'count_a' => $query_banner_a->func()->count('*'),
                        'as_date' => 'DATE(created)'
                    ])
                    ->where(['type' => 'Banner A'])
                    ->group('as_date');
        foreach($all_banner_a as $banner_a) {
            $data_banner_a['sum'] += $banner_a->count_a;
            if($banner_a->as_date == $dateNow) $data_banner_a['now'] = $banner_a->count;
        }
        $all_banner_b = $query_banner_b->select([
                        'count_b' => $query_banner_b->func()->count('*'),
                        'as_date' => 'DATE(created)'
                    ])
                    ->where(['type' => 'Banner B'])
                    ->group('as_date');
        foreach($all_banner_b as $banner_b) {
            $data_banner_b['sum'] += $banner_b->count_b;
            if($banner_b->as_date == $dateNow) $data_banner_b['now'] = $banner_b->count;
        }
        $this->set(compact('all_banner_a', 'all_banner_b', 'data_banner_a', 'data_banner_b'));
    }

    private function article_stat($dateNow) {
        $data_article = ['sum' => 0, 'now' => 0];
        $query_article = $this->Articles->find();
        $all_article = $query_article->select([
                        'count' => $query_article->func()->count('*'),
                        'as_date' => 'DATE(created)'
                    ])
                    ->group('as_date');
        foreach($all_article as $article) {
            $data_article['sum'] += $article->count;
            if($article->as_date == $dateNow) $data_article['now'] = $article->count;
        }
        $this->set(compact('all_article', 'data_article'));
    }

    private function contact_stat($dateNow) {
        $data_contact = ['sum' => 0, 'now' => 0];
        $query_contact = $this->Contacts->find();
        $all_contact = $query_contact->select([
                        'count' => $query_contact->func()->count('*'),
                        'as_date' => 'DATE(created)'
                    ])
                    ->group('as_date');
        foreach($all_contact as $contact) {
            $data_contact['sum'] += $contact->count;
            if($contact->as_date == $dateNow) $data_contact['now'] = $contact->count;
        }
        $this->set(compact('all_contact', 'data_contact'));
    }

    private function message_stat($dateNow) {
        $data_message = ['sum' => 0, 'now' => 0];
        $query_message = $this->Messages->find();
        $all_message = $query_message->select([
                        'count' => $query_message->func()->count('*'),
                        'as_date' => 'DATE(created)'
                    ])
                    ->where(['type' => 'review'])
                    ->group('as_date');
        foreach($all_message as $message) {
            $data_message['sum'] += $message->count;
            if($message->as_date == $dateNow) $data_message['now'] = $message->count;
        }
        $this->set(compact('all_message', 'data_message'));
    }

    

}
