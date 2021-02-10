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
        $this->Visitors = TableRegistry::get('VisitorCounters');
    }
   

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $dateNow = date('Y-m-d');

        $this->web_visitor($dateNow);

        $this->sale_visitor($dateNow);

        $this->new_visitor($dateNow);

        $this->twohand_visitor($dateNow);

        $this->asset_ads_stat($dateNow);

        $this->asset_free_stat($dateNow);

        $this->user_stat($dateNow);

        $this->banner_stat($dateNow);

        $this->article_stat($dateNow);

        $this->contact_stat($dateNow);

        $this->message_stat($dateNow);
    }

    
    private function web_visitor($dateNow) {
        $data_web = ['sum' => 0, 'now' => 0];
        $query_webview = $this->Visitors->find();
        $all_view = $query_webview->select([
                    'count' => $query_webview->func()->sum('today'),
                    'as_date' => 'DATE(created)'
                ])
                ->where(['type' => 'web'])
                ->group('as_date');
        
        foreach($all_view as $view) {
            $data_web['sum'] += $view->count;
            if($view->as_date == $dateNow) $data_web['now'] = $view->count;
        }
        $webview_json = json_encode($all_view);
        $this->set(compact('all_view', 'data_web', 'webview_json'));
    }


    private function sale_visitor($dateNow) {
        $data_sale = ['sum' => 0, 'now' => 0];
        $query_saleview = $this->Visitors->find();
        $all_sale = $query_saleview->select([
                    'count' => $query_saleview->func()->sum('today'),
                    'as_date' => 'DATE(created)'
                ])
                ->where(['type' => 'sale'])
                ->group('as_date');
        
        foreach($all_sale as $sale) {
            $data_sale['sum'] += $sale->count;
            if($sale->as_date == $dateNow) $data_sale['now'] = $sale->count;
        }
        $saleview_json = json_encode($all_sale);
        $this->set(compact('all_sale', 'data_sale', 'saleview_json'));
    }


    private function new_visitor($dateNow) {
        $data_new = ['sum' => 0, 'now' => 0];
        $query_newview = $this->Visitors->find();
        $all_new = $query_newview->select([
                    'count' => $query_newview->func()->sum('today'),
                    'as_date' => 'DATE(created)'
                ])
                ->where(['type' => 'new'])
                ->group('as_date');
        
        foreach($all_new as $new) {
            $data_new['sum'] += $new->count;
            if($new->as_date == $dateNow) $data_new['now'] = $new->count;
        }
        $newview_json = json_encode($all_new);
        $this->set(compact('all_new', 'data_new', 'newview_json'));
    }


    private function twohand_visitor($dateNow) {
        $data_2hand = ['sum' => 0, 'now' => 0];
        $query_2handview = $this->Visitors->find();
        $all_2hand = $query_2handview->select([
                    'count' => $query_2handview->func()->sum('today'),
                    'as_date' => 'DATE(created)'
                ])
                ->where(['type' => '2hand'])
                ->group('as_date');
        
        foreach($all_2hand as $twohand) {
            $data_2hand['sum'] += $twohand->count;
            if($twohand->as_date == $dateNow) $data_2hand['now'] = $twohand->count;
        }
        $twohand_json = json_encode($all_2hand);
        $this->set(compact('all_2hand', 'data_2hand', 'twohand_json'));
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
        $ads_json = json_encode($all_ads);
        $this->set(compact('all_ads', 'data_ads', 'ads_json'));
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
        $free_json = json_encode($all_free);
        $this->set(compact('all_free', 'data_free', 'free_json'));
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
        $user_json = json_encode($all_users);
        $this->set(compact('all_users', 'data_user', 'user_json'));
    }

    private function banner_stat($dateNow) {
        $data_banner_a = ['sum' => 0, 'now' => 0];
        $data_banner_b = ['sum' => 0, 'now' => 0];
        $query_banner_a = $this->Banners->find();
        $query_banner_b = $this->Banners->find();
        $all_banner_a = $query_banner_a->select([
                        'count' => $query_banner_a->func()->count('*'),
                        'as_date' => 'DATE(created)'
                    ])
                    ->where(['type' => 'Banner A'])
                    ->group('as_date');
        foreach($all_banner_a as $banner_a) {
            $data_banner_a['sum'] += $banner_a->count;
            if($banner_a->as_date == $dateNow) $data_banner_a['now'] = $banner_a->count;
        }
        $all_banner_b = $query_banner_b->select([
                        'count' => $query_banner_b->func()->count('*'),
                        'as_date' => 'DATE(created)'
                    ])
                    ->where(['type' => 'Banner B'])
                    ->group('as_date');
        foreach($all_banner_b as $banner_b) {
            $data_banner_b['sum'] += $banner_b->count;
            if($banner_b->as_date == $dateNow) $data_banner_b['now'] = $banner_b->count;
        }
        $banner_a_json = json_encode($all_banner_a);
        $banner_b_json = json_encode($all_banner_b);
        $this->set(compact('all_banner_a', 'all_banner_b', 'data_banner_a', 'data_banner_b', 'banner_a_json', 'banner_b_json'));
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
        $article_json = json_encode($all_article);
        $this->set(compact('all_article', 'data_article', 'article_json'));
    }

    private function contact_stat($dateNow) {
        $data_contact = ['sum' => 0, 'now' => 0];
        $query_contact = $this->Messages->find();
        $all_contact = $query_contact->select([
                        'count' => $query_contact->func()->count('*'),
                        'as_date' => 'DATE(created)'
                    ])
                    ->where(['type' => 'contact'])
                    ->group('as_date');
        foreach($all_contact as $contact) {
            $data_contact['sum'] += $contact->count;
            if($contact->as_date == $dateNow) $data_contact['now'] = $contact->count;
        }
        $contact_json = json_encode($all_contact);
        $this->set(compact('all_contact', 'data_contact', 'contact_json'));
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
        $message_json = json_encode($all_message);
        $this->set(compact('all_message', 'data_message', 'message_json'));
    }


    public function dashboard() {
        
    }

    

}
