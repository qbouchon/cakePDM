<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Configuration Model
 *
 * @method \App\Model\Entity\Configuration newEmptyEntity()
 * @method \App\Model\Entity\Configuration newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Configuration[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Configuration get($primaryKey, $options = [])
 * @method \App\Model\Entity\Configuration findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Configuration patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Configuration[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Configuration|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Configuration saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Configuration[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Configuration[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Configuration[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Configuration[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ConfigurationTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('configuration');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

        $validator
            ->scalar('home_text')
            ->maxLength('home_text', 4294967295)
            ->allowEmptyString('home_text');
        $validator
            ->scalar('reminder_mail_text')
            ->maxLength('reminder_mail_text', 4294967295)
            ->allowEmptyString('reminder_mail_text');
        $validator
            ->scalar('reminder_mail_oject')
            ->maxLength('reminder_mail_oject', 255)
            ->allowEmptyString('reminder_mail_oject');

        $validator
            ->scalar('home_picture')
            ->maxLength('home_picture', 255)
            ->allowEmptyString('home_picture');

        $validator
            ->scalar('home_picture_path')
            ->maxLength('home_picture_path', 255)
            ->allowEmptyString('home_picture_path');
        $validator
            ->boolean('send_mail_resa_admin')
            ->allowEmptyString('send_mail_resa_admin');
        $validator
            ->boolean('send_mail_edit_resa_admin')
            ->allowEmptyString('send_mail_edit_resa_admin');
        $validator
            ->boolean('send_mail_delete_resa_admin')
            ->allowEmptyString('send_mail_delete_resa_admin');
        $validator
            ->boolean('send_mail_resa_user')
            ->allowEmptyString('send_mail_resa_user');
        $validator
            ->boolean('send_mail_edit_resa_user')
            ->allowEmptyString('send_mail_edit_resa_user');
        $validator
            ->boolean('send_mail_delete_resa_user')
            ->allowEmptyString('send_mail_delete_resa_user');
        $validator
            ->boolean('send_mail_back_resa_user')
            ->allowEmptyString('send_mail_back_resa_user');

        return $validator;
    }
}
