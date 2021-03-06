<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Banners Controller
 *
 * @property \App\Model\Table\BannersTable $Banners
 *
 * @method \App\Model\Entity\Banner[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BannersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $docStatusList = $this->Core->getStatusCode();
        $docStatusPayment = $this->Core->getStatusCodePayment();
        $notificationBanner = $this->loadComponent('Notification');

        $banners = $this->Banners->find()
                        ->contain(['Users','UserPackages' => ['UserPackageLines' => ['UserPayments']],'Images'])
                        ->order(['Banners.modified' => 'DESC'])
                        ->toArray();
        $this->set(compact('banners', 'docStatusPayment', 'notificationBanner'));

        $this->UserPackageLines = TableRegistry::get('user_package_lines');
        $q = $this->UserPackageLines->find()
                    ->contain(['UserPayments' => ['Images']])
                    ->order(['user_package_lines.created' => 'DESC']);
        $user_package_lines = $q->toArray();

        $this->set(compact('user_package_lines', 'docStatusList'));
    }

    public function bannerExp() {
        $this->BannerLines = TableRegistry::get('banner_lines');

        $q = $this->BannerLines->find()
                    ->contain(['Banners' => ['Users','UserPackages'], 'Images'])
                    ->where(['UserPackages.status' => 'EX'])
                    ->order(['banner_lines.created' => 'DESC']);
        $banner_lines = $q->toArray();
        $this->set(compact('banner_lines'));
    }

    public function view($id = null)
    {
        $banner = $this->Banners->get($id, [
            'contain' => ['Users', 'Images']
        ]);

        $this->set('banner', $banner);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $banner = $this->Banners->newEntity();
        if ($this->request->is('post')) {
            $banner = $this->Banners->patchEntity($banner, $this->request->getData());
            if ($this->Banners->save($banner)) {
                $this->Flash->success(__('The banner has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The banner could not be saved. Please, try again.'));
        }
        $users = $this->Banners->Users->find('list', ['limit' => 200]);
        $images = $this->Banners->Images->find('list', ['limit' => 200]);
        $this->set(compact('banner', 'users', 'images'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Banner id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $banner = $this->Banners->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $banner = $this->Banners->patchEntity($banner, $this->request->getData());
            if ($this->Banners->save($banner)) {
                $this->Flash->success(__('The banner has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The banner could not be saved. Please, try again.'));
        }
        $users = $this->Banners->Users->find('list', ['limit' => 200]);
        $images = $this->Banners->Images->find('list', ['limit' => 200]);
        $this->set(compact('banner', 'users', 'images'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Banner id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $banner = $this->Banners->get($id);
        if ($this->Banners->delete($banner)) {
            $this->Flash->success(__('The banner has been deleted.'));
        } else {
            $this->Flash->error(__('The banner could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

     public function saveactive() {
        $this->BannerLines = TableRegistry::get('banner_lines');
        $this->autoRender = false;

        $id = $this->request->getQuery('id');
        $banner = $this->BannerLines->get($id);

        if ($banner->isactive == 'Y') {
            $banner->isactive = "N";
        } else {
            $banner->isactive = "Y";
        }
        if ($this->BannerLines->save($banner)) {
            echo json_encode('Success');
            $this->Flash->success(__('Success.'));
        }else{
            $this->Flash->error(__('Error.'));
            echo json_encode('Error');
        }
        
    }
}
