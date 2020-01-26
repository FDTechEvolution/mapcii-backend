<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Addresses Model
 *
 * @property \App\Model\Table\SubdistrictsTable|\Cake\ORM\Association\BelongsTo $Subdistricts
 * @property \App\Model\Table\DistrictsTable|\Cake\ORM\Association\BelongsTo $Districts
 * @property \App\Model\Table\ProvincesTable|\Cake\ORM\Association\BelongsTo $Provinces
 * @property \App\Model\Table\AssetsTable|\Cake\ORM\Association\HasMany $Assets
 * @property \App\Model\Table\UserAddressesTable|\Cake\ORM\Association\HasMany $UserAddresses
 *
 * @method \App\Model\Entity\Address get($primaryKey, $options = [])
 * @method \App\Model\Entity\Address newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Address[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Address|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Address|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Address patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Address[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Address findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AddressesTable extends Table
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

        $this->setTable('addresses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Subdistricts', [
            'foreignKey' => 'subdistrict_id'
        ]);
        $this->belongsTo('Districts', [
            'foreignKey' => 'district_id'
        ]);
        $this->belongsTo('Provinces', [
            'foreignKey' => 'province_id'
        ]);
        $this->hasMany('Assets', [
            'foreignKey' => 'address_id'
        ]);
        $this->hasMany('UserAddresses', [
            'foreignKey' => 'address_id'
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
            ->scalar('address1')
            ->maxLength('address1', 255)
            ->allowEmpty('address1');

        $validator
            ->scalar('address2')
            ->maxLength('address2', 255)
            ->allowEmpty('address2');

        $validator
            ->scalar('moo')
            ->maxLength('moo', 100)
            ->allowEmpty('moo');

        $validator
            ->scalar('soi')
            ->maxLength('soi', 100)
            ->allowEmpty('soi');

        $validator
            ->scalar('street')
            ->maxLength('street', 255)
            ->allowEmpty('street');

        $validator
            ->scalar('zipcode')
            ->maxLength('zipcode', 10)
            ->allowEmpty('zipcode');

        $validator
            ->scalar('description')
            ->allowEmpty('description');

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
        $rules->add($rules->existsIn(['subdistrict_id'], 'Subdistricts'));
        $rules->add($rules->existsIn(['district_id'], 'Districts'));
        $rules->add($rules->existsIn(['province_id'], 'Provinces'));

        return $rules;
    }
}
