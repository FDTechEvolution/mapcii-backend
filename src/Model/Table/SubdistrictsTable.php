<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Subdistricts Model
 *
 * @property \App\Model\Table\DistrictsTable|\Cake\ORM\Association\BelongsTo $Districts
 * @property |\Cake\ORM\Association\BelongsTo $Provinces
 * @property \App\Model\Table\AddressesTable|\Cake\ORM\Association\HasMany $Addresses
 *
 * @method \App\Model\Entity\Subdistrict get($primaryKey, $options = [])
 * @method \App\Model\Entity\Subdistrict newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Subdistrict[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Subdistrict|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Subdistrict|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Subdistrict patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Subdistrict[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Subdistrict findOrCreate($search, callable $callback = null, $options = [])
 */
class SubdistrictsTable extends Table
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

        $this->setTable('subdistricts');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Districts', [
            'foreignKey' => 'district_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Provinces', [
            'foreignKey' => 'province_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Addresses', [
            'foreignKey' => 'subdistrict_id'
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('code')
            ->maxLength('code', 6)
            ->requirePresence('code', 'create')
            ->notEmpty('code');

        $validator
            ->scalar('name')
            ->maxLength('name', 150)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('name_en')
            ->maxLength('name_en', 150)
            ->requirePresence('name_en', 'create')
            ->notEmpty('name_en');

        $validator
            ->integer('geoid')
            ->requirePresence('geoid', 'create')
            ->notEmpty('geoid');

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
        $rules->add($rules->existsIn(['district_id'], 'Districts'));
        $rules->add($rules->existsIn(['province_id'], 'Provinces'));

        return $rules;
    }
}
