<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\ImagesTable|\Cake\ORM\Association\BelongsTo $Images
 * @property \App\Model\Table\AccessesTable|\Cake\ORM\Association\HasMany $Accesses
 * @property \App\Model\Table\AssetsTable|\Cake\ORM\Association\HasMany $Assets
 * @property \App\Model\Table\BannersTable|\Cake\ORM\Association\HasMany $Banners
 * @property \App\Model\Table\PaymentBackupsTable|\Cake\ORM\Association\HasMany $PaymentBackups
 * @property \App\Model\Table\PaymentsTable|\Cake\ORM\Association\HasMany $Payments
 * @property \App\Model\Table\UserAddressesTable|\Cake\ORM\Association\HasMany $UserAddresses
 * @property \App\Model\Table\UserFavoritesTable|\Cake\ORM\Association\HasMany $UserFavorites
 * @property \App\Model\Table\UserPackagesTable|\Cake\ORM\Association\HasMany $UserPackages
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Images', [
            'foreignKey' => 'image_id'
        ]);
        $this->hasMany('Accesses', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Assets', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Banners', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('PaymentBackups', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Payments', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UserAddresses', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UserFavorites', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UserPackages', [
            'foreignKey' => 'user_id'
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
            ->scalar('usercode')
            ->maxLength('usercode', 100)
            ->allowEmpty('usercode');

        $validator
            ->scalar('title')
            ->maxLength('title', 60)
            ->allowEmpty('title');

        $validator
            ->scalar('firstname')
            ->maxLength('firstname', 100)
            ->requirePresence('firstname', 'create')
            ->notEmpty('firstname');

        $validator
            ->scalar('lastname')
            ->maxLength('lastname', 100)
            ->requirePresence('lastname', 'create')
            ->notEmpty('lastname');

        $validator
            ->scalar('username')
            ->maxLength('username', 100)
            ->allowEmpty('username');

        $validator
            ->scalar('password')
            ->maxLength('password', 100)
            ->allowEmpty('password');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 100)
            ->allowEmpty('phone');

        $validator
            ->scalar('lineid')
            ->maxLength('lineid', 100)
            ->allowEmpty('lineid');

        $validator
            ->scalar('facebook')
            ->maxLength('facebook', 255)
            ->allowEmpty('facebook');

        $validator
            ->scalar('fax')
            ->maxLength('fax', 100)
            ->allowEmpty('fax');

        $validator
            ->scalar('isactive')
            ->allowEmpty('isactive');

        $validator
            ->scalar('isverify')
            ->allowEmpty('isverify');

        $validator
            ->scalar('islocked')
            ->allowEmpty('islocked');

        $validator
            ->scalar('iscustomer')
            ->allowEmpty('iscustomer');

        $validator
            ->scalar('isseller')
            ->allowEmpty('isseller');

        $validator
            ->scalar('gender')
            ->allowEmpty('gender');

        $validator
            ->scalar('verifycode')
            ->maxLength('verifycode', 255)
            ->allowEmpty('verifycode');

        $validator
            ->scalar('position')
            ->maxLength('position', 100)
            ->allowEmpty('position');

        $validator
            ->scalar('issubscription')
            ->allowEmpty('issubscription');

        $validator
            ->date('locktime')
            ->allowEmpty('locktime');

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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['image_id'], 'Images'));

        return $rules;
    }
}
