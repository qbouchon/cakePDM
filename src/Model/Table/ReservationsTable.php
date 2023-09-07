<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;
use Cake\I18n\FrozenDate;

/**
 * Reservations Model
 *
 * @property \App\Model\Table\ResourcesTable&\Cake\ORM\Association\BelongsTo $Resources
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Reservation newEmptyEntity()
 * @method \App\Model\Entity\Reservation newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Reservation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Reservation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Reservation findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Reservation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Reservation[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Reservation|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reservation saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reservation[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Reservation[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Reservation[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Reservation[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ReservationsTable extends Table
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

        $this->setTable('reservations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Resources', [
            'foreignKey' => 'resource_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
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
            ->date('start_date')
            ->requirePresence('start_date', 'create')
            ->notEmptyDate('start_date')
            ->add('start_date', 'checkStartDate', [
                'rule' => [$this, 'checkStartDate'],
                'message' => 'Vous ne pouvez pas reserver de ressource avant le lendemain de la demande',
            ])
            ->add('start_date', 'checkDates', [
                'rule' => [$this, 'checkDates'],
                'message' => 'La date de début de réservation doit être avant la date de fin.',
            ])
            ->add('start_date', 'checkOverlapeReservation', [
                'rule' => [$this, 'checkOverlapeReservation'],
                'message' => "La ressource n'est pas disponible à ces dates",
            ])
            ->add('start_date', 'checkClosingDateStart', [
                'rule' => [$this, 'checkClosingDateStart'],
                'message' => "Le Crest est fermé à cette date",
            ])
            ->add('start_date', 'notOnSaturday', [
            'rule' => function ($value, $context) {
                $date = new FrozenTime($value);
                return $date->format('N') != 6; // 6 represents Saturday
            },
            'message' => 'La date de début de réservation ne peut pas être un samedi.'
            ])
            ->add('start_date', 'notOnSunday', [
            'rule' => function ($value, $context) {
                $date = new FrozenTime($value);
                return $date->format('N') != 7; // 7 represents Sunday
            },
            'message' => 'La date de début ne peut pas être un dimanche.'
            ]);


 

        $validator
            ->date('end_date')
            ->requirePresence('end_date', 'create')
            ->notEmptyDate('end_date')
            ->add('end_date', 'checkReservationDuration', [
                'rule' => [$this, 'checkReservationDuration'],
                'message' => "La Reservation dépasse la durée maximal d'emprunt pour cette ressource",
            ])
            ->add('end_date', 'checkOverlapeReservation', [
                'rule' => [$this, 'checkOverlapeReservation'],
                'message' => "La ressource n'est pas disponible à ces dates",
            ])
            ->add('end_date', 'checkClosingDateEnd', [
                'rule' => [$this, 'checkClosingDateEnd'],
                'message' => "Le Crest est fermé à cette date",
            ])
            ->add('end_date', 'notOnSaturday', [
            'rule' => function ($value, $context) {
                $date = new FrozenTime($value);
                return $date->format('N') != 6; // 6 represents Saturday
            },
            'message' => 'La date de fin de réservation ne peut pas être un samedi.'
            ])
            ->add('end_date', 'notOnSunday', [
            'rule' => function ($value, $context) {
                $date = new FrozenTime($value);
                return $date->format('N') != 7; // 7 represents Sunday
            },
            'message' => 'La date de fin ne peut pas être un dimanche.'
            ]);

         

        $validator
            ->boolean('is_back')
            ->allowEmptyString('is_back');

        $validator
            ->date('back_date')
            ->allowEmptyDate('back_date');

        $validator
            ->integer('resource_id')
            ->notEmptyString('resource_id');

        $validator
            ->integer('user_id')
            ->notEmptyString('user_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('resource_id', 'Resources'), ['errorField' => 'resource_id']);
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }

    
    public function checkStartDate($value, $context)
    {
        $today = FrozenTime::now();
        // debug('today' . $today->i18nFormat('yyyy-MM-dd'));
        // echo $today;
        // debug($this->start_date);
        // die;
        $start_date = new FrozenTime($context['data']['start_date']);


        if($start_date<=$today)
            return false; 
        
        
        return true;
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

    //Check if the duration of reservation is not greater than the maximum duration for the specific resource
    public function checkReservationDuration($value, $context)
    {
        $start_date = new FrozenTime($context['data']['start_date']);
        $end_date = new FrozenTime($context['data']['end_date']);
        $resource = $this->Resources->get($context['data']['resource_id']);

        $durationInDays = ($end_date->getTimestamp() - $start_date->getTimestamp()) / (24 * 60 * 60);
        if($durationInDays > $resource->max_duration && $resource->max_duration > 0) //On considère 0 et les valeur négative comme une possibilité de réservation illimitée
            return false;
        else
            return true;
    }

    //Check if there is no overlape reservation for the resource
    public function checkOverlapeReservation($value, $context)
    {
        $start_date = new FrozenTime($context['data']['start_date']);
        $end_date = new FrozenTime($context['data']['end_date']);
        $resource = $this->Resources->get($context['data']['resource_id'],['contain' => 'Reservations']);
        // debug($context['data']);
        // die;

         //Dans le cas où on est en train d'éditer une réservation, on ne veut pas checker les dates de cette réservation
        if (isset($context['data']['id']) && $context['data']['id'])
        {
                
            foreach($resource->reservations as $reservation)
            {
                   
                if($reservation->start_date <= $end_date && $reservation->end_date >= $start_date && !$reservation->is_back && $reservation->id != $context['data']['id']){
                            return false;
                }

            }
        }
        else
            foreach($resource->reservations as $reservation)
            {
                   
                if($reservation->start_date <= $end_date && $reservation->end_date >= $start_date && !$reservation->is_back){
                            return false;
                }

            }
        

        return true;
    }


     //Check if start_date before end_date
    public function checkClosingDateStart($value, $context)
    {
        $start_date = new FrozenDate($context['data']['start_date']);
        $end_date = new FrozenDate($context['data']['end_date']);


        $now = FrozenDate::now();
        $closingDatesTable = TableRegistry::getTableLocator()->get('ClosingDates');

        $closingDates = $closingDatesTable->find()
                  ->where([
                                'start_date >=' => $now  //Inutil de checker les dates passées, un utilisateur ne peut pas créer de réservation dans le passé                     
                    ])
                  ->toArray();

                  foreach($closingDates as $closingDate)
                  {
                     
                        $sDate = new FrozenDate($closingDate->start_date);
                        $eDate = new FrozenDate($closingDate->end_date);

                        while($sDate <= $eDate)
                        {

                            if($start_date == $sDate)
                                return false;

                            $sDate = $sDate->addDays(1);
                        }
                  }

        return true;


    }

    public function checkClosingDateEnd($value, $context)
    {
        $start_date = new FrozenDate($context['data']['start_date']);
        $end_date = new FrozenDate($context['data']['end_date']);


        $now = FrozenDate::now();
        $closingDatesTable = TableRegistry::getTableLocator()->get('ClosingDates');

        $closingDates = $closingDatesTable->find()
                  ->where([
                                'start_date >=' => $now  //Inutil de checker les dates passées, un utilisateur ne peut pas créer de réservation dans le passé                     
                    ])
                  ->toArray();

                  foreach($closingDates as $closingDate)
                  {
                     
                        $sDate = new FrozenDate($closingDate->start_date);
                        $eDate = new FrozenDate($closingDate->end_date);

                        while($sDate <= $eDate)
                        {

                            if($end_date == $sDate)
                                return false;

                            $sDate = $sDate->addDays(1);
                        }
                  }

        return true;


    }

}
