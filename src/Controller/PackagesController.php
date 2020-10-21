<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
/**
 * Packages Controller
 *
 * @property \App\Model\Table\PackagesTable $Packages
 *
 * @method \App\Model\Entity\Package[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PackagesController extends AppController {

    public $UserPackages = null;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->UserPackages = TableRegistry::get('UserPackages');
        $this->Sizes = TableRegistry::get('Sizes');
        $this->Positions = TableRegistry::get('Positions');
        $this->PackageTypes = TableRegistry::get('PackageTypes');
        $this->PackageDurations = TableRegistry::get('PackageDurations');
        $this->PackageLines = TableRegistry::get('PackageLines');
    }
    public function index() {
      
        $packages = $this->Packages->find('all')
                    ->contain(['Sizes']);
        $this->set(compact('packages'));
    }

    /**
     * View method
     *
     * @param string|null $id Package id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $package = $this->Packages->get($id, [
            'contain' => ['Sizes']
        ]);

        $this->set('package', $package);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $package = $this->Packages->newEntity();
        if ($this->request->is('post')) {
            $package = $this->Packages->patchEntity($package, $this->request->getData());
            if ($this->Packages->save($package)) {
                $this->Flash->success(__('The package has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The package could not be saved. Please, try again.'));
        }

        $sizes = $this->Sizes->find('all');

        $positions = $this->Positions->find('all');

        $types = $this->PackageTypes->find('all');        

        $this->set(compact('package','sizes','positions','types'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Package id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $package = $this->Packages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $package = $this->Packages->patchEntity($package, $this->request->getData());
            if ($this->Packages->save($package)) {
                $this->Flash->success(__('The package has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The package could not be saved. Please, try again.'));
        }
        $this->set(compact('package'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Package id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $package = $this->Packages->get($id);
        $q = $this->UserPackages->find()
                ->where(['package_id' => $id])
                ->first();
        if (sizeof($q) > 0) {
            $this->Flash->error(__('The package in use could not be deleted.'));
        } else {
              if ($this->Packages->delete($package)) {
            $this->Flash->success(__('The package has been deleted.'));
        } else {
            $this->Flash->error(__('The package could not be deleted. Please, try again.'));
        }
        }

     

        return $this->redirect(['action' => 'index']);
    }

    public function announceAdIndex() {
        $packagelines = $this->PackageLines->find('all')
                    ->contain(['PackageDurations', 'Packages', 'Sizes'])
                    ->where(['Packages.name' => 'ประกาศ (AD)'])
                    ->order(['Sizes.created' => 'ASC', 'PackageDurations.duration_exp' => 'ASC']);
        $this->set(compact('packagelines'));

        $this->render('AnnounceAd/index');
    }

    public function announceAdAdd() {
        if ($this->request->is('post')) {
            $package = $this->Packages->newEntity();
            $postData = $this->request->getData();
            $package->name = $postData['name'];
            if ($this->Packages->save($package)) {
                for($i=0; $i<count($postData['isprice']); $i++){
                    $package_line = $this->PackageLines->newEntity();
                    $package_line->package_id = $package->id;
                    $package_line->size_id = $postData['size'][$i];
                    $package_line->isprice = $postData['isprice'][$i];
                    $package_line->iscredit = $postData['iscredit'][$i];
                    $package_line->proprice = $postData['proprice'][$i];
                    $package_line->procredit = $postData['procredit'][$i];
                    $package_line->package_duration_id = $postData['package_duration_id'][$i];
                    $this->PackageLines->save($package_line);
                }
                $this->Flash->success(__('The package has been saved.'));

                return $this->redirect(array('controller' => 'packages', 'action'=> 'announce-ad-index'));
            }
            $this->Flash->error(__('The package could not be saved. Please, try again.'));
        }

        $package = '';
        $durations = $this->PackageDurations->find('all')->order(['duration_exp' => 'ASC']);
        $sizes = $this->Sizes->find('all')->toArray();     
        $this->set(compact('package','durations','sizes'));

        $this->render('AnnounceAd/add');
    }

    public function announceAdEdit() {
        if ($this->request->getData()) {
            $postData = $this->request->getData();
            $success = 0;
            $this->log($postData, 'debug');
            for($i=0; $i<count($postData['isprice']); $i++){
                $packagelines = $this->PackageLines->get($postData['id'][$i]);
                $packagelines->isprice = $postData['isprice'][$i];
                $packagelines->iscredit = $postData['iscredit'][$i];
                $packagelines->proprice = $postData['proprice'][$i];
                $packagelines->procredit = $postData['procredit'][$i];

                $this->PackageLines->save($packagelines);
                $success++;
            }

            if($success == count($postData['isprice'])) {
                $this->Flash->success(__('The package has been saved.'));

                return $this->redirect(array('controller' => 'packages', 'action'=> 'announce-ad-index'));
            }

            $this->Flash->error(__('The package could not be saved. Please, try again.'));
        }

        $package = $this->Packages->find('all')
                    ->contain(['PackageLines' => ['PackageDurations', 'Sizes']])
                    ->where(['Packages.name' => 'ประกาศ (AD)'])
                    ->first();
        $sizes = $this->Sizes->find('all')->toArray(); 
        $this->set(compact('package','sizes'));

        $this->render('AnnounceAd/edit');
    }

    public function bannerAIndex() {
        $packagelines = $this->PackageLines->find('all')
                    ->contain(['PackageDurations', 'Packages'])
                    ->where(['Packages.name' => 'Banner A'])
                    ->order(['PackageDurations.duration_exp' => 'ASC']);
        $this->set(compact('packagelines'));

        $this->render('BannerA/index');
    }

    public function bannerAAdd() {
        if ($this->request->is('post')) {
            $package = $this->Packages->newEntity();
            $postData = $this->request->getData();
            $package->name = $postData['name'];
            if ($this->Packages->save($package)) {
                for($i=0; $i<count($postData['isprice']); $i++){
                    $package_line = $this->PackageLines->newEntity();
                    $package_line->package_id = $package->id;
                    $package_line->isprice = $postData['isprice'][$i];
                    $package_line->iscredit = $postData['iscredit'][$i];
                    $package_line->proprice = $postData['proprice'][$i];
                    $package_line->procredit = $postData['procredit'][$i];
                    $package_line->package_duration_id = $postData['package_duration_id'][$i];
                    $this->PackageLines->save($package_line);
                }
                $this->Flash->success(__('The package has been saved.'));

                return $this->redirect(array('controller' => 'packages', 'action'=> 'banner-a-index'));
            }
            $this->Flash->error(__('The package could not be saved. Please, try again.'));
        }

        $package = '';
        $durations = $this->PackageDurations->find('all');
        $types = $this->PackageTypes->find('all')->order(['name' => 'ASC']);        
        $this->set(compact('package','durations','types'));

        $this->render('BannerA/add');
    }

    public function bannerAEdit() {
        if ($this->request->getData()) {
            $postData = $this->request->getData();
            $success = 0;
            for($i=0; $i<count($postData['isprice']); $i++){
                $packagelines = $this->PackageLines->get($postData['id'][$i]);
                $packagelines->isprice = $postData['isprice'][$i];
                $packagelines->iscredit = $postData['iscredit'][$i];
                $packagelines->proprice = $postData['proprice'][$i];
                $packagelines->procredit = $postData['procredit'][$i];

                $this->PackageLines->save($packagelines);
                $success++;
            }

            if($success == count($postData['isprice'])) {
                $this->Flash->success(__('The package has been saved.'));

                return $this->redirect(array('controller' => 'packages', 'action'=> 'banner-a-index'));
            }

            $this->Flash->error(__('The package could not be saved. Please, try again.'));
        }

        $package = $this->Packages->find('all')
                    ->contain(['PackageLines' => ['PackageDurations']])
                    ->where(['Packages.name' => 'Banner A'])
                    ->first();
        $this->set(compact('package'));

        $this->render('BannerA/edit');
    }

    public function bannerBIndex() {
        $packagelines = $this->PackageLines->find('all')
                    ->contain(['PackageDurations', 'Packages'])
                    ->where(['Packages.name' => 'Banner B'])
                    ->order(['PackageDurations.duration_exp' => 'ASC']);
        $this->set(compact('packagelines'));

        $this->render('BannerB/index');
    }

    public function bannerBAdd() {
        if ($this->request->is('post')) {
            $package = $this->Packages->newEntity();
            $postData = $this->request->getData();
            $package->name = $postData['name'];
            if ($this->Packages->save($package)) {
                for($i=0; $i<count($postData['isprice']); $i++){
                    $package_line = $this->PackageLines->newEntity();
                    $package_line->package_id = $package->id;
                    $package_line->isprice = $postData['isprice'][$i];
                    $package_line->iscredit = $postData['iscredit'][$i];
                    $package_line->proprice = $postData['proprice'][$i];
                    $package_line->procredit = $postData['procredit'][$i];
                    $package_line->package_duration_id = $postData['package_duration_id'][$i];
                    $this->PackageLines->save($package_line);
                }
                $this->Flash->success(__('The package has been saved.'));

                return $this->redirect(array('controller' => 'packages', 'action'=> 'banner-b-index'));
            }
            $this->Flash->error(__('The package could not be saved. Please, try again.'));
        }

        $package = '';
        $durations = $this->PackageDurations->find('all');
        $types = $this->PackageTypes->find('all')->order(['name' => 'ASC']);        
        $this->set(compact('package','durations','types'));

        $this->render('BannerB/add');
    }

    public function bannerBEdit() {
        if ($this->request->getData()) {
            $postData = $this->request->getData();
            $success = 0;
            for($i=0; $i<count($postData['isprice']); $i++){
                $packagelines = $this->PackageLines->get($postData['id'][$i]);
                $packagelines->isprice = $postData['isprice'][$i];
                $packagelines->iscredit = $postData['iscredit'][$i];
                $packagelines->proprice = $postData['proprice'][$i];
                $packagelines->procredit = $postData['procredit'][$i];

                $this->PackageLines->save($packagelines);
                $success++;
            }

            if($success == count($postData['isprice'])) {
                $this->Flash->success(__('The package has been saved.'));

                return $this->redirect(array('controller' => 'packages', 'action'=> 'banner-b-index'));
            }

            $this->Flash->error(__('The package could not be saved. Please, try again.'));
        }

        $package = $this->Packages->find('all')
                    ->contain(['PackageLines' => ['PackageDurations']])
                    ->where(['Packages.name' => 'Banner B'])
                    ->first();
        $this->set(compact('package'));

        $this->render('BannerB/edit');
    }

}
