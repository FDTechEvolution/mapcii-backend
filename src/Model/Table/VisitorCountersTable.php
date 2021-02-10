<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VisitorCounters Model
 *
 * @method \App\Model\Entity\VisitorCounter get($primaryKey, $options = [])
 * @method \App\Model\Entity\VisitorCounter newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VisitorCounter[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VisitorCounter|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VisitorCounter|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VisitorCounter patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VisitorCounter[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VisitorCounter findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VisitorCountersTable extends Table
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

        $this->setTable('visitor_counters');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('type')
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->integer('today')
            ->requirePresence('today', 'create')
            ->notEmpty('today');

        $validator
            ->date('on_date')
            ->requirePresence('on_date', 'create')
            ->notEmpty('on_date');

        return $validator;
    }
}
