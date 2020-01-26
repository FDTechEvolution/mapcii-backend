<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AssetTypes Model
 *
 * @property \App\Model\Table\ImagesTable|\Cake\ORM\Association\BelongsTo $Images
 * @property \App\Model\Table\AssetCategoriesTable|\Cake\ORM\Association\BelongsTo $AssetCategories
 * @property \App\Model\Table\AssetsTable|\Cake\ORM\Association\HasMany $Assets
 *
 * @method \App\Model\Entity\AssetType get($primaryKey, $options = [])
 * @method \App\Model\Entity\AssetType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AssetType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AssetType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssetType|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssetType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AssetType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AssetType findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AssetTypesTable extends Table
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

        $this->setTable('asset_types');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Images', [
            'foreignKey' => 'image_id'
        ]);
        $this->belongsTo('AssetCategories', [
            'foreignKey' => 'asset_category_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Assets', [
            'foreignKey' => 'asset_type_id'
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
            ->integer('seq')
            ->allowEmpty('seq');

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
        $rules->add($rules->existsIn(['image_id'], 'Images'));
        //$rules->add($rules->existsIn(['asset_category_id'], 'AssetCategories'));

        return $rules;
    }
}
