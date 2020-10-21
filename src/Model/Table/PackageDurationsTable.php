<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PackageDurations Model
 *
 * @method \App\Model\Entity\PackageDuration get($primaryKey, $options = [])
 * @method \App\Model\Entity\PackageDuration newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PackageDuration[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PackageDuration|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PackageDuration|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PackageDuration patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PackageDuration[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PackageDuration findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PackageDurationsTable extends Table
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

        $this->setTable('package_durations');
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
            ->scalar('duration_name')
            ->maxLength('duration_name', 20)
            ->requirePresence('duration_name', 'create')
            ->notEmpty('duration_name');

        $validator
            ->integer('duration_exp')
            ->requirePresence('duration_exp', 'create')
            ->notEmpty('duration_exp');

        return $validator;
    }
}
