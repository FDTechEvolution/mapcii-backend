<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Histories Controller
 *
 *
 * @method \App\Model\Entity\History[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HistoriesController extends AppController
{
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Users = TableRegistry::get('Users');
        $this->Assets = TableRegistry::get('Assets');
        $this->Banners = TableRegistry::get('Banners');
        $this->Articles = TableRegistry::get('Articles');
        $this->Messages = TableRegistry::get('Messages');
        $this->AssetAds = TableRegistry::get('AssetAds');
        $this->AssetImages = TableRegistry::get('AssetImages');
        $this->UserPackageLines = TableRegistry::get('UserPackageLines');

    }

    
    public function index()
    {
        $users = $this->getUsers();
        $this->getAds();
        $this->getFreeAssets();
        $this->getBanners();
        $articles = $this->getArticles();
        $this->getContacts();
        $this->getReviews();

        $this->set(compact('users', 'articles'));
    }

    private function getUsers() {
        $users = $this->Users->find()
                ->contain(['Images'])
                ->where(['Users.isactive' => 'N'])
                ->order(['Users.created' => 'DESC'])
                ->toArray();

        return $users;
    }

    private function getAds() {
        $q = $this->AssetAds->find();
                $q->select([
                    'id' => 'Assets.id', 
                    'code' => 'Assets.code', 
                    'topic' => 'Assets.name',
                    'startdate' => 'Assets.startdate', 
                    'name' => 'Users.firstname', 
                    'lname' => 'Users.lastname',
                    'type' => 'AssetTypes.name',
                    'user_package_id' => 'UserPackages.id',
                    'order_code' => 'UserPackages.order_code',
                    'price' => 'Assets.price',
                    'discount' => 'Assets.discount',
                    'rental' => 'Assets.rental',
                    'reason_del' => 'Assets.reason_del'
                ])
                ->contain(['Assets' => ['AssetTypes', 'Users', 'AssetImages' => ['Images']], 'UserPackages' => ['UserPackageLines' => ['UserPayments']]])
                ->where(['Assets.status' => 'DL'])
                ->order(['AssetAds.created' => 'DESC']);
        $ads = $q->toArray();

        $userpackage = [];
        $assetImage = [];
        foreach($ads as $ad) {
            $query = $this->UserPackageLines->find()
                        ->where(['user_package_id' => $ad->user_package_id])
                        ->last();
            array_push($userpackage, $query);

            $img = $this->AssetImages->find()
                        ->contain(['Images'])
                        ->where(['AssetImages.asset_id' => $ad->id, 'AssetImages.isdefault' => 'Y'])
                        ->first();
            array_push($assetImage, $img);
        }
        $this->set(compact('ads', 'userpackage', 'assetImage'));
    }

    private function getFreeAssets() {
        $assets = $this->Assets->find()
                ->contain(['AssetTypes', 'Users', 'AssetImages' => ['Images']])
                ->where(['Assets.status' => 'DL'])
                ->order(['Assets.created' => 'DESC'])
                ->toArray();

        $assetFreeImage = [];
        $assetFree = [];
        foreach($assets as $asset) {
            $ads = $this->AssetAds->find()->where(['asset_id' => $asset->id])->first();
            if(sizeof($ads) == 0) {
                array_push($assetFree, $asset);
            }
            $img = $this->AssetImages->find()
                        ->contain(['Images'])
                        ->where(['AssetImages.asset_id' => $asset->id, 'AssetImages.isdefault' => 'Y'])
                        ->first();
            array_push($assetFreeImage, $img);
        }

        $this->set(compact('assetFree', 'assetFreeImage'));
    }

    private function getBanners() {
        $b = $this->Banners->find();
            $b->select([
                'id' => 'Banners.id',
                'topic' => 'Banners.topic',
                'startdate' => 'Banners.created',
                'name' => 'Users.firstname',
                'lname' => 'Users.lastname',
                'type' => 'Banners.type',
                'user_package_id' => 'UserPackages.id',
                'order_code' => 'UserPackages.order_code',
                'image' => 'Images.url',
                'reason_del' => 'Banners.reason_del'
            ])
            ->contain(['Users', 'Images', 'UserPackages' => ['UserPackageLines']])
            ->where(['Banners.status' => 'DL'])
            ->order(['Banners.created' => 'DESC']);
        $banners = $b->toArray();
        $user_banner_package = [];
        foreach($banners as $banner) {
            $query = $this->UserPackageLines->find()
                        ->where(['user_package_id' => $banner->user_package_id])
                        ->last();
            array_push($user_banner_package, $query);
        }
        $this->set(compact('banners', 'user_banner_package'));
    }

    private function getArticles() {
        $articles = $this->Articles->find()
                ->contain(['Images', 'Users'])
                ->where(['Articles.isactive' => 'N'])
                ->order(['Articles.created' => 'DESC'])
                ->toArray();

        return $articles;
    }

    private function getContacts() {
        $contacts = $this->Messages->find()
                ->contain(['Assets'])
                ->where(['Messages.status' => 'DL', 'Messages.type' => 'contact'])
                ->order(['Messages.created' => 'DESC'])
                ->toArray();

        $usercontacts = [];
        foreach($contacts as $contact):
            $users = $this->Users->find()->where(['id' => $contact->from_user])->first();
            array_push($usercontacts, $users);
        endforeach;

        $this->set(compact('contacts', 'usercontacts'));
    }

    private function getReviews() {
        $reviews = $this->Messages->find()
                ->contain(['Assets'])
                ->where(['Messages.status' => 'DL', 'Messages.type' => 'review'])
                ->order(['Messages.created' => 'DESC'])
                ->toArray();

        $userreviews = [];
        foreach($reviews as $review):
            $users = $this->Users->find()->where(['id' => $review->from_user])->first();
            array_push($userreviews, $users);
        endforeach;

        $this->set(compact('reviews', 'userreviews'));
    }

}
