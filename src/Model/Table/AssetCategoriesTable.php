<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AssetCategories Model
 *
 * @property \App\Model\Table\AssetTypesTable|\Cake\ORM\Association\HasMany $AssetTypes
 *
 * @method \App\Model\Entity\AssetCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\AssetCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AssetCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AssetCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssetCategory|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssetCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AssetCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AssetCategory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AssetCategoriesTable extends Table
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

        $this->setTable('asset_categories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('AssetTypes', [
            'foreignKey' => 'asset_category_id'
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
            ->integer('seq')
            ->allowEmpty('seq');

        return $validator;
    }
}
