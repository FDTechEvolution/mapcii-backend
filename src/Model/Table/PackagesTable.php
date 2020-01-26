<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Packages Model
 *
 * @property \App\Model\Table\UserPackagesTable|\Cake\ORM\Association\HasMany $UserPackages
 *
 * @method \App\Model\Entity\Package get($primaryKey, $options = [])
 * @method \App\Model\Entity\Package newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Package[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Package|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Package|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Package patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Package[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Package findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PackagesTable extends Table
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

        $this->setTable('packages');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('UserPackages', [
            'foreignKey' => 'package_id'
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
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmpty('description');

        $validator
            ->decimal('monthly_price')
            ->allowEmpty('monthly_price');

        $validator
            ->decimal('quarterly_price')
            ->allowEmpty('quarterly_price');

        $validator
            ->decimal('semiannual_price')
            ->allowEmpty('semiannual_price');

        $validator
            ->decimal('annual_price')
            ->allowEmpty('annual_price');

        $validator
            ->uuid('createdby')
            ->allowEmpty('createdby');

        return $validator;
    }
}
