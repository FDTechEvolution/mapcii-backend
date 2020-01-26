<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

/**
 * Description of Utils
 *
 * @author sakorn.s
 */
class CoreComponent extends Component {

    public $Users = null;
    public $Roles = null;
    public $SystemUsages = null;
    public $Plants = null;
    public $Warehouses = null;
    public $PlantGroups = null;
    public $Rawmatstocks = null;
    public $AssetCategories = null;

    public function getassetcate($plantid = null) {
        $this->AssetCategories = TableRegistry::get('AssetCategories');

        $q = $this->AssetCategories->find()
                ->select(['id', 'name'])
                ->where()
                ->order(['AssetCategories.seq' => 'ASC']);
        $cate = $q->toArray();

        $list = [];
        foreach ($cate as $item) {
            //array_push($list, [$item['id']=>$item['firstname'].'  '.$item['lastname']]);
            $list[$item['id']] = $item['name'];
        }
        $this->log($list,'debug');
        return $list;
    }

    public function getLocalOrgId() {
        return $this->request->session()->read('Global.org_id');
    }

    public function isMultipleBranch() {
        if ($this->request->session()->read('Global.ismultiple_branch') == 'Y') {
            return true;
        } else {
            return false;
        }
    }

    public function getPlantsList() {
        $this->Plants = TableRegistry::get('Plants');

        $q = $this->Plants->find()
                ->select(['id', 'name'])
                ->where(['Plants.isactive' => 'Y'])
                ->order(['Plants.name' => 'ASC']);
        $plants = $q->toArray();

        $list = [];
        foreach ($plants as $item) {
            //array_push($list, [$item['id']=>$item['firstname'].'  '.$item['lastname']]);
            $list[$item['id']] = $item['name'];
        }
        return $list;
    }

    public function getRolesList() {
        $this->Roles = TableRegistry::get('Roles');

        $q = $this->Roles->find()
                ->order(['name' => 'ASC']);
        $roles = $q->toArray();

        $list = [];
        foreach ($roles as $item) {
            //array_push($list, [$item['id']=>$item['firstname'].'  '.$item['lastname']]);
            $list[$item->id] = $item['name'];
            //$this->log($list,'debug');
        }
        return $list;
    }

    public function getsellerList() {
        $this->Users = TableRegistry::get('Users');

        $q = $this->Users->find()
                ->where(['isseller' => 'Y'])
                ->order(['Users.fullname' => 'ASC']);
        $seller = $q->toArray();

        $list = [];
        foreach ($seller as $item) {
            //array_push($list, [$item['id']=>$item['firstname'].'  '.$item['lastname']]);
            $list[$item->id] = $item['fullname'];
            //$this->log($list,'debug');
        }
        return $list;
    }

    public function getPlantgroupList() {
        $this->PlantGroups = TableRegistry::get('PlantGroups');

        $q = $this->PlantGroups->find()
                ->select(['id', 'name'])
                ->where()
                ->order(['PlantGroups.name' => 'ASC']);
        $plants = $q->toArray();

        $list = [];
        foreach ($plants as $item) {
            //array_push($list, [$item['id']=>$item['firstname'].'  '.$item['lastname']]);
            $list[$item['id']] = $item['name'];
        }
        return $list;
    }

    public function getStockList() {
        $this->Rawmatstocks = TableRegistry::get('Rawmatstocks');

        $q = $this->Rawmatstocks->find()
                ->select(['Rawmatstocks.id', 'Plants.name'])
                ->contain(['Plants'])
                ->where(['Rawmatstocks.org_id is null'])
                ->order(['Plants.name' => 'ASC']);
        $stock = $q->toArray();

        $list = [];
        foreach ($stock as $item) {

            $list[$item['id']] = $item['plant']['name'];
        }
        return $list;
    }

    public function getStockMain() {
        $this->Rawmatstocks = TableRegistry::get('Rawmatstocks');

        $stock = $this->Rawmatstocks->find()
                ->where(['Rawmatstocks.org_id is not' => null])
                ->first();


        return $stock;
    }
    public function getStatusCode($type = null) {
        /*
         * DR = Draft
         * CO = Complete
         * VO = Void
         */
        $data = [];
        if (is_null($type)) {
            $data = [
                'DR' => ['code' => 'DR', 'name' => 'ค้างชำระ'],
                'CO' => ['code' => 'CO', 'name' => 'ชำระเงินแล้ว'],
                
                'VO' => ['code' => 'VO', 'name' => 'ยกเลิกแล้ว']
            ];
        } elseif ($type == 'list') {
            $data = ['DR' => 'ค้างชำระ', 'CO' => 'ชำระเงินแล้ว', 'VO' => 'ยกเลิกแล้ว'];
        }
        return $data;
    }

}
