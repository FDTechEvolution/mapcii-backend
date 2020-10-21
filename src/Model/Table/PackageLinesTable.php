<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PackageLines Model
 *
 * @property \App\Model\Table\PackagesTable|\Cake\ORM\Association\BelongsTo $Packages
 * @property |\Cake\ORM\Association\BelongsTo $Sizes
 * @property \App\Model\Table\PackageDurationsTable|\Cake\ORM\Association\BelongsTo $PackageDurations
 *
 * @method \App\Model\Entity\PackageLine get($primaryKey, $options = [])
 * @method \App\Model\Entity\PackageLine newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PackageLine[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PackageLine|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PackageLine|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PackageLine patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PackageLine[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PackageLine findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PackageLinesTable extends Table
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

        $this->setTable('package_lines');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Packages', [
            'foreignKey' => 'package_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Sizes', [
            'foreignKey' => 'size_id'
        ]);
        $this->belongsTo('PackageDurations', [
            'foreignKey' => 'package_duration_id',
            'joinType' => 'INNER'
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
            ->decimal('isprice')
            ->requirePresence('isprice', 'create')
            ->notEmpty('isprice');

        $validator
            ->integer('iscredit')
            ->requirePresence('iscredit', 'create')
            ->notEmpty('iscredit');

        $validator
            ->decimal('proprice')
            ->allowEmpty('proprice');

        $validator
            ->integer('procredit')
            ->allowEmpty('procredit');

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
        $rules->add($rules->existsIn(['package_id'], 'Packages'));
        $rules->add($rules->existsIn(['size_id'], 'Sizes'));
        $rules->add($rules->existsIn(['package_duration_id'], 'PackageDurations'));

        return $rules;
    }
}
