<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AssetImages Model
 *
 * @property \App\Model\Table\AssetsTable|\Cake\ORM\Association\BelongsTo $Assets
 * @property \App\Model\Table\ImagesTable|\Cake\ORM\Association\BelongsTo $Images
 *
 * @method \App\Model\Entity\AssetImage get($primaryKey, $options = [])
 * @method \App\Model\Entity\AssetImage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AssetImage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AssetImage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssetImage|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssetImage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AssetImage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AssetImage findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AssetImagesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('asset_images');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Assets', [
            'foreignKey' => 'asset_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Images', [
            'foreignKey' => 'image_id',
            'joinType' => 'INNER',
            
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->uuid('id')
                ->allowEmpty('id', 'create');

        $validator
                ->scalar('isdefault')
                ->requirePresence('isdefault', 'create')
                ->notEmpty('isdefault');

        $validator
                ->integer('seq')
                ->requirePresence('seq', 'create')
                ->notEmpty('seq');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['asset_id'], 'Assets'));
        $rules->add($rules->existsIn(['image_id'], 'Images'));

        return $rules;
    }

}
