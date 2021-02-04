<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Assets Model
 *
 * @property \App\Model\Table\AssetTypesTable|\Cake\ORM\Association\BelongsTo $AssetTypes
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\AddressesTable|\Cake\ORM\Association\BelongsTo $Addresses
 * @property \App\Model\Table\AssetAdsTable|\Cake\ORM\Association\HasMany $AssetAds
 * @property \App\Model\Table\AssetImagesTable|\Cake\ORM\Association\HasMany $AssetImages
 * @property \App\Model\Table\AssetOptionsTable|\Cake\ORM\Association\HasMany $AssetOptions
 * @property \App\Model\Table\MessagesTable|\Cake\ORM\Association\HasMany $Messages
 * @property \App\Model\Table\UserFavoritesTable|\Cake\ORM\Association\HasMany $UserFavorites
 *
 * @method \App\Model\Entity\Asset get($primaryKey, $options = [])
 * @method \App\Model\Entity\Asset newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Asset[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Asset|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Asset|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Asset patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Asset[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Asset findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AssetsTable extends Table
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

        $this->setTable('assets');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('AssetTypes', [
            'foreignKey' => 'asset_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Addresses', [
            'foreignKey' => 'address_id'
        ]);
        $this->hasMany('AssetAds', [
            'foreignKey' => 'asset_id'
        ]);
        $this->hasMany('AssetImages', [
            'foreignKey' => 'asset_id'
        ]);
        $this->hasMany('AssetOptions', [
            'foreignKey' => 'asset_id'
        ]);
        $this->hasMany('Messages', [
            'foreignKey' => 'asset_id'
        ]);
        $this->hasMany('UserFavorites', [
            'foreignKey' => 'asset_id'
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
            ->scalar('code')
            ->maxLength('code', 255)
            ->requirePresence('code', 'create')
            ->notEmpty('code');

        $validator
            ->scalar('announce')
            ->maxLength('announce', 40)
            ->requirePresence('announce', 'create')
            ->notEmpty('announce');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->decimal('floor')
            ->allowEmpty('floor');

        $validator
            ->integer('bedroom')
            ->allowEmpty('bedroom');

        $validator
            ->integer('bathroom')
            ->allowEmpty('bathroom');

        $validator
            ->integer('kitchenroom')
            ->allowEmpty('kitchenroom');

        $validator
            ->integer('receptionroom')
            ->allowEmpty('receptionroom');

        $validator
            ->integer('diningroom')
            ->allowEmpty('diningroom');

        $validator
            ->integer('maidroom')
            ->allowEmpty('maidroom');

        $validator
            ->integer('parking')
            ->allowEmpty('parking');

        $validator
            ->scalar('description')
            ->maxLength('description', 4294967295)
            ->allowEmpty('description');

        $validator
            ->scalar('isactive')
            ->allowEmpty('isactive');

        $validator
            ->date('expire_date')
            ->allowEmpty('expire_date');

        $validator
            ->decimal('landsize_1')
            ->allowEmpty('landsize_1');

        $validator
            ->decimal('landsize_2')
            ->allowEmpty('landsize_2');

        $validator
            ->decimal('landsize_3')
            ->allowEmpty('landsize_3');

        $validator
            ->decimal('usefulspace')
            ->allowEmpty('usefulspace');

        $validator
            ->scalar('type')
            ->maxLength('type', 45)
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->integer('total_publish_day')
            ->allowEmpty('total_publish_day');

        $validator
            ->date('startdate')
            ->allowEmpty('startdate');

        $validator
            ->date('enddate')
            ->allowEmpty('enddate');

        $validator
            ->dateTime('up_to_top')
            ->allowEmpty('up_to_top');

        $validator
            ->scalar('status')
            ->maxLength('status', 45)
            ->allowEmpty('status');

        $validator
            ->decimal('price')
            ->allowEmpty('price');

        $validator
            ->decimal('discount')
            ->allowEmpty('discount');

        $validator
            ->decimal('rental')
            ->allowEmpty('rental');

        $validator
            ->scalar('isnewproject')
            ->allowEmpty('isnewproject');

        $validator
            ->scalar('issales')
            ->allowEmpty('issales');

        $validator
            ->scalar('isrent')
            ->allowEmpty('isrent');

        $validator
            ->scalar('reason_del')
            ->maxLength('reason_del', 255)
            ->allowEmpty('reason_del');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['asset_type_id'], 'AssetTypes'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['address_id'], 'Addresses'));

        return $rules;
    }
}
