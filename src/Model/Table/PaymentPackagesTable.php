<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PaymentPackages Model
 *
 * @property \App\Model\Table\PaymentsTable|\Cake\ORM\Association\HasMany $Payments
 *
 * @method \App\Model\Entity\PaymentPackage get($primaryKey, $options = [])
 * @method \App\Model\Entity\PaymentPackage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PaymentPackage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PaymentPackage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PaymentPackage|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PaymentPackage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PaymentPackage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PaymentPackage findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PaymentPackagesTable extends Table
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

        $this->setTable('payment_packages');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Payments', [
            'foreignKey' => 'payment_package_id'
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
            ->scalar('duration')
            ->maxLength('duration', 20)
            ->requirePresence('duration', 'create')
            ->notEmpty('duration');

        $validator
            ->scalar('package')
            ->maxLength('package', 100)
            ->requirePresence('package', 'create')
            ->notEmpty('package');

        return $validator;
    }
}
