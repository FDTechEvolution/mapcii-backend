<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Appsettings Model
 *
 * @method \App\Model\Entity\Appsetting get($primaryKey, $options = [])
 * @method \App\Model\Entity\Appsetting newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Appsetting[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Appsetting|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Appsetting|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Appsetting patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Appsetting[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Appsetting findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AppsettingsTable extends Table
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

        $this->setTable('appsettings');
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
            ->scalar('email_receiver_contact')
            ->maxLength('email_receiver_contact', 255)
            ->allowEmpty('email_receiver_contact');

        $validator
            ->scalar('email_receiver_seller')
            ->maxLength('email_receiver_seller', 255)
            ->allowEmpty('email_receiver_seller');

        $validator
            ->scalar('email_receiver_purchase')
            ->maxLength('email_receiver_purchase', 255)
            ->allowEmpty('email_receiver_purchase');

        return $validator;
    }
}
