<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\FrozenTime;

/**
 * ClosingDates Model
 *
 * @method \App\Model\Entity\ClosingDate newEmptyEntity()
 * @method \App\Model\Entity\ClosingDate newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ClosingDate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ClosingDate get($primaryKey, $options = [])
 * @method \App\Model\Entity\ClosingDate findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ClosingDate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ClosingDate[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ClosingDate|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClosingDate saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClosingDate[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ClosingDate[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ClosingDate[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ClosingDate[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ClosingDatesTable extends Table
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

        $this->setTable('closing_dates');
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
            ->date('start_date')
            ->requirePresence('start_date', 'create')
            ->notEmptyDate('start_date')
            ->add('start_date', 'checkDates', [
                'rule' => [$this, 'checkDates'],
                'message' => 'La date de début doit être avant la date de fin.',
            ]);

        $validator
            ->date('end_date')
            ->requirePresence('end_date', 'create')
            ->notEmptyDate('end_date');

        return $validator;
    }


//Check if start_date before end_date
    public function checkDates($value, $context)
    {
        $start_date = new FrozenTime($context['data']['start_date']);
        $end_date = new FrozenTime($context['data']['end_date']);

        if($end_date < $start_date)
            return false;
        else
            return true;
    }
}