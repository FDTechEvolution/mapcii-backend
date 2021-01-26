<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Banners Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\UserPackagesTable|\Cake\ORM\Association\BelongsTo $UserPackages
 * @property \App\Model\Table\ImagesTable|\Cake\ORM\Association\BelongsTo $Images
 * @property \App\Model\Table\BannerLinesTable|\Cake\ORM\Association\HasMany $BannerLines
 *
 * @method \App\Model\Entity\Banner get($primaryKey, $options = [])
 * @method \App\Model\Entity\Banner newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Banner[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Banner|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Banner|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Banner patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Banner[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Banner findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BannersTable extends Table
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

        $this->setTable('banners');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('UserPackages', [
            'foreignKey' => 'user_package_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Images', [
            'foreignKey' => 'image_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('BannerLines', [
            'foreignKey' => 'banner_id'
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
            ->scalar('type')
            ->maxLength('type', 10)
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->scalar('topic')
            ->maxLength('topic', 255)
            ->requirePresence('topic', 'create')
            ->notEmpty('topic');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmpty('description');

        $validator
            ->scalar('isapproved')
            ->allowEmpty('isapproved');

        $validator
            ->scalar('status')
            ->maxLength('status', 2)
            ->allowEmpty('status');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['user_package_id'], 'UserPackages'));
        $rules->add($rules->existsIn(['image_id'], 'Images'));

        return $rules;
    }
}
