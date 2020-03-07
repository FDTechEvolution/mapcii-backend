<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PaymentLines Model
 *
 * @property \App\Model\Table\PaymentsTable|\Cake\ORM\Association\BelongsTo $Payments
 * @property \App\Model\Table\FinancialAccountsTable|\Cake\ORM\Association\BelongsTo $FinancialAccounts
 * @property \App\Model\Table\ImagesTable|\Cake\ORM\Association\BelongsTo $Images
 *
 * @method \App\Model\Entity\PaymentLine get($primaryKey, $options = [])
 * @method \App\Model\Entity\PaymentLine newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PaymentLine[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PaymentLine|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PaymentLine|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PaymentLine patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PaymentLine[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PaymentLine findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PaymentLinesTable extends Table
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

        $this->setTable('payment_lines');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Payments', [
            'foreignKey' => 'payment_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('FinancialAccounts', [
            'foreignKey' => 'financial_account_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Images', [
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
            ->scalar('documentno')
            ->maxLength('documentno', 50)
            ->allowEmpty('documentno');

        $validator
            ->scalar('payment_method')
            ->maxLength('payment_method', 10)
            ->requirePresence('payment_method', 'create')
            ->notEmpty('payment_method');

        $validator
            ->date('payment_date')
            ->requirePresence('payment_date', 'create')
            ->notEmpty('payment_date');

        $validator
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

        $validator
            ->scalar('package_name')
            ->maxLength('package_name', 255)
            ->requirePresence('package_name', 'create')
            ->notEmpty('package_name');

        $validator
            ->scalar('package_duration')
            ->maxLength('package_duration', 20)
            ->requirePresence('package_duration', 'create')
            ->notEmpty('package_duration');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->scalar('status')
            ->maxLength('status', 2)
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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
        $rules->add($rules->existsIn(['payment_id'], 'Payments'));
        $rules->add($rules->existsIn(['financial_account_id'], 'FinancialAccounts'));
        $rules->add($rules->existsIn(['image_id'], 'Images'));

        return $rules;
    }
}
