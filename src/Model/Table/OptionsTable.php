<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Options Model
 *
 * @property \App\Model\Table\AssetOptionsTable|\Cake\ORM\Association\HasMany $AssetOptions
 *
 * @method \App\Model\Entity\Option get($primaryKey, $options = [])
 * @method \App\Model\Entity\Option newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Option[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Option|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Option|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Option patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Option[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Option findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OptionsTable extends Table
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

        $this->setTable('options');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('AssetOptions', [
            'foreignKey' => 'option_id'
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
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('value')
            ->maxLength('value', 255)
            ->allowEmpty('value');

        $validator
            ->scalar('type')
            ->maxLength('type', 255)
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->integer('seq')
            ->allowEmpty('seq');

        $validator
            ->uuid('createdby')
            ->allowEmpty('createdby');

        $validator
            ->uuid('modifiedby')
            ->allowEmpty('modifiedby');

        return $validator;
    }
}
