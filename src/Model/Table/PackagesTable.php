<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Packages Model
 *
 * @property \App\Model\Table\SizesTable|\Cake\ORM\Association\BelongsTo $Sizes
 * @property \App\Model\Table\PackageDurationsTable|\Cake\ORM\Association\BelongsTo $PackageDurations
 * @property \App\Model\Table\PackageTypesTable|\Cake\ORM\Association\BelongsTo $PackageTypes
 * @property |\Cake\ORM\Association\HasMany $PackageLines
 * @property \App\Model\Table\PaymentsTable|\Cake\ORM\Association\HasMany $Payments
 * @property |\Cake\ORM\Association\HasMany $UserPackageLines
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

        $this->belongsTo('Sizes', [
            'foreignKey' => 'size_id'
        ]);
        $this->belongsTo('PackageDurations', [
            'foreignKey' => 'package_duration_id'
        ]);
        $this->belongsTo('PackageTypes', [
            'foreignKey' => 'package_type_id'
        ]);
        $this->hasMany('PackageLines', [
            'foreignKey' => 'package_id'
        ]);
        $this->hasMany('Payments', [
            'foreignKey' => 'package_id'
        ]);
        $this->hasMany('UserPackageLines', [
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
            ->decimal('isprice')
            ->allowEmpty('isprice');

        $validator
            ->integer('isqty')
            ->allowEmpty('isqty');

        $validator
            ->decimal('proprice')
            ->allowEmpty('proprice');

        $validator
            ->integer('proqty')
            ->allowEmpty('proqty');

        $validator
            ->scalar('showpage')
            ->allowEmpty('showpage');

        $validator
            ->scalar('showcase')
            ->allowEmpty('showcase');

        $validator
            ->uuid('createdby')
            ->allowEmpty('createdby');

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
        $rules->add($rules->existsIn(['size_id'], 'Sizes'));
        $rules->add($rules->existsIn(['package_duration_id'], 'PackageDurations'));
        $rules->add($rules->existsIn(['package_type_id'], 'PackageTypes'));

        return $rules;
    }
}
