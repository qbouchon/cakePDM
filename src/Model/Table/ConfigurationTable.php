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
        $validator
            ->scalar('home_picture')
            ->maxLength('home_picture', 255)
            ->allowEmptyString('home_picture');
        $validator
            ->scalar('mail_protocol')
            ->maxLength('mail_protocol', 255)
            ->allowEmptyString('mail_protocol');
        $validator
            ->scalar('mail_host')
            ->maxLength('mail_host', 255)
            ->allowEmptyString('mail_host');
        $validator
            ->scalar('mail_port')
            ->maxLength('mail_port', 255)
            ->allowEmptyString('mail_port');
        $validator
            ->scalar('mail_username')
            ->maxLength('mail_username', 255)
            ->allowEmptyString('mail_username');
        $validator
            ->scalar('mail_password')
            ->maxLength('mail_password', 255)
            ->allowEmptyString('mail_password');
        $validator
            ->add('start_hour_monday', 'custom', [
                'rule' => function ($value, $context) {
                    if ($context['data']['open_monday'] == true) {
                        return !empty($value);
                    }
                    return true;
                },
                'message' => 'L\'heure d\'ouverture doit être définie.',
            ])
            ->add('end_hour_monday', 'custom', [
                'rule' => function ($value, $context) {
                    if ($context['data']['open_monday'] == true) {
                        return !empty($value);
                    }
                    return true;
                },
                'message' => 'L\'heure de fermeture doit être définie.',
            ])
            ->allowEmptyString('start_hour_monday')
            ->allowEmptyString('end_hour_monday')
            ->allowEmptyString('start_hour_tuesday')
            ->allowEmptyString('end_hour_tuesday')
            ->allowEmptyString('start_hour_wednesday')
            ->allowEmptyString('end_hour_wednesday')
            ->allowEmptyString('start_hour_thursday')
            ->allowEmptyString('end_hour_thursday')
            ->allowEmptyString('start_hour_friday')
            ->allowEmptyString('end_hour_friday')
            ->maxLength('start_hour_monday', 5)
            ->maxLength('end_hour_monday', 5)
            ->maxLength('start_hour_tuesday', 5)
            ->maxLength('end_hour_tuesday', 5)
            ->maxLength('start_hour_wednesday', 5)
            ->maxLength('end_hour_wednesday', 5)
            ->maxLength('start_hour_thursday', 5)
            ->maxLength('end_hour_thursday', 5)
            ->maxLength('start_hour_friday', 5)
            ->maxLength('end_hour_friday', 5);


        return $validator;
    }
}
