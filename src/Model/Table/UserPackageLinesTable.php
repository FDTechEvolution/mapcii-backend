<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserPackageLines Model
 *
 * @property \App\Model\Table\UserPackagesTable|\Cake\ORM\Association\BelongsTo $UserPackages
 * @property |\Cake\ORM\Association\BelongsTo $PackageLines
 * @property \App\Model\Table\UserPaymentsTable|\Cake\ORM\Association\HasMany $UserPayments
 *
 * @method \App\Model\Entity\UserPackageLine get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserPackageLine newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserPackageLine[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserPackageLine|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserPackageLine|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserPackageLine patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserPackageLine[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserPackageLine findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserPackageLinesTable extends Table
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

        $this->setTable('user_package_lines');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('UserPackages', [
            'foreignKey' => 'user_package_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('PackageLines', [
            'foreignKey' => 'package_line_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('UserPayments', [
            'foreignKey' => 'user_package_line_id'
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
            ->scalar('package_name')
            ->maxLength('package_name', 255)
            ->requirePresence('package_name', 'create')
            ->notEmpty('package_name');

        $validator
            ->scalar('size')
            ->maxLength('size', 1)
            ->allowEmpty('size');

        $validator
            ->scalar('order_code')
            ->maxLength('order_code', 20)
            ->requirePresence('order_code', 'create')
            ->notEmpty('order_code');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->integer('credit')
            ->requirePresence('credit', 'create')
            ->notEmpty('credit');

        $validator
            ->date('buy_date')
            ->requirePresence('buy_date', 'create')
            ->notEmpty('buy_date');

        $validator
            ->date('paid_date')
            ->allowEmpty('paid_date');

        $validator
            ->date('start_date')
            ->allowEmpty('start_date');

        $validator
            ->date('end_date')
            ->allowEmpty('end_date');

        $validator
            ->scalar('ispaid')
            ->allowEmpty('ispaid');

        $validator
            ->scalar('isexpire')
            ->allowEmpty('isexpire');

        $validator
            ->scalar('duration_name')
            ->maxLength('duration_name', 255)
            ->requirePresence('duration_name', 'create')
            ->notEmpty('duration_name');

        $validator
            ->integer('duration')
            ->requirePresence('duration', 'create')
            ->notEmpty('duration');

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
        $rules->add($rules->existsIn(['user_package_id'], 'UserPackages'));
        $rules->add($rules->existsIn(['package_line_id'], 'PackageLines'));

        return $rules;
    }
}
