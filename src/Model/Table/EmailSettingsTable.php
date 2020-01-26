<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmailSettings Model
 *
 * @method \App\Model\Entity\EmailSetting get($primaryKey, $options = [])
 * @method \App\Model\Entity\EmailSetting newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EmailSetting[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EmailSetting|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmailSetting|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmailSetting patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EmailSetting[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EmailSetting findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmailSettingsTable extends Table
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

        $this->setTable('email_settings');
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('email_isenable')
            ->allowEmpty('email_isenable');

        $validator
            ->scalar('email_server')
            ->maxLength('email_server', 60)
            ->allowEmpty('email_server');

        $validator
            ->scalar('email_port')
            ->maxLength('email_port', 60)
            ->allowEmpty('email_port');

        $validator
            ->scalar('email_username')
            ->maxLength('email_username', 60)
            ->allowEmpty('email_username');

        $validator
            ->scalar('email_password')
            ->maxLength('email_password', 60)
            ->allowEmpty('email_password');

        $validator
            ->scalar('email_address')
            ->maxLength('email_address', 60)
            ->allowEmpty('email_address');

        $validator
            ->scalar('email_title')
            ->maxLength('email_title', 60)
            ->allowEmpty('email_title');

        return $validator;
    }
}
