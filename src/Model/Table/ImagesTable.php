<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Images Model
 *
 * @property |\Cake\ORM\Association\HasMany $Articles
 * @property \App\Model\Table\AssetImagesTable|\Cake\ORM\Association\HasMany $AssetImages
 * @property \App\Model\Table\AssetTypesTable|\Cake\ORM\Association\HasMany $AssetTypes
 * @property \App\Model\Table\BannersTable|\Cake\ORM\Association\HasMany $Banners
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\Image get($primaryKey, $options = [])
 * @method \App\Model\Entity\Image newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Image[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Image|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Image|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Image patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Image[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Image findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ImagesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('images');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Articles', [
            'foreignKey' => 'image_id'
        ]);
        $this->hasMany('AssetImages', [
            'foreignKey' => 'image_id'
        ]);
        $this->hasMany('AssetTypes', [
            'foreignKey' => 'image_id'
        ]);
        $this->hasMany('Banners', [
            'foreignKey' => 'image_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'image_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->uuid('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('type')
            ->maxLength('type', 20)
            ->allowEmpty('type');

        $validator
            ->scalar('path')
            ->allowEmpty('path');

        $validator
            ->scalar('url')
            ->maxLength('url', 255)
            ->allowEmpty('url');

        return $validator;
    }
}
