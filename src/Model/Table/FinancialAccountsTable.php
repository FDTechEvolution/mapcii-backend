<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FinancialAccounts Model
 *
 * @property \App\Model\Table\PaymentsTable|\Cake\ORM\Association\HasMany $Payments
 *
 * @method \App\Model\Entity\FinancialAccount get($primaryKey, $options = [])
 * @method \App\Model\Entity\FinancialAccount newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FinancialAccount[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FinancialAccount|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FinancialAccount|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FinancialAccount patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FinancialAccount[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FinancialAccount findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FinancialAccountsTable extends Table
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

        $this->setTable('financial_accounts');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Payments', [
            'foreignKey' => 'financial_account_id'
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
            ->allowEmpty('name');

        $validator
            ->scalar('type')
            ->maxLength('type', 45)
            ->allowEmpty('type');

        $validator
            ->scalar('accountno')
            ->maxLength('accountno', 100)
            ->allowEmpty('accountno');

        return $validator;
    }
}
