<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserPayments Model
 *
 * @property \App\Model\Table\UserPackageLinesTable|\Cake\ORM\Association\BelongsTo $UserPackageLines
 * @property \App\Model\Table\ImagesTable|\Cake\ORM\Association\BelongsTo $Images
 *
 * @method \App\Model\Entity\UserPayment get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserPayment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserPayment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserPayment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserPayment|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserPayment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserPayment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserPayment findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserPaymentsTable extends Table
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

        $this->setTable('user_payments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('UserPackageLines', [
            'foreignKey' => 'user_package_line_id',
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
            ->maxLength('documentno', 20)
            ->allowEmpty('documentno');

        $validator
            ->scalar('payment_method')
            ->maxLength('payment_method', 10)
            ->allowEmpty('payment_method');

        $validator
            ->date('payment_date')
            ->allowEmpty('payment_date');

        $validator
            ->scalar('status')
            ->allowEmpty('status');

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
        $rules->add($rules->existsIn(['user_package_line_id'], 'UserPackageLines'));
        $rules->add($rules->existsIn(['image_id'], 'Images'));

        return $rules;
    }
}
