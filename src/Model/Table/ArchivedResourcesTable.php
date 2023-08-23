<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ArchivedResources Model
 *
 * @property \App\Model\Table\DomainsTable&\Cake\ORM\Association\BelongsTo $Domains
 *
 * @method \App\Model\Entity\ArchivedResource newEmptyEntity()
 * @method \App\Model\Entity\ArchivedResource newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ArchivedResource[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ArchivedResource get($primaryKey, $options = [])
 * @method \App\Model\Entity\ArchivedResource findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ArchivedResource patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ArchivedResource[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ArchivedResource|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ArchivedResource saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ArchivedResource[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ArchivedResource[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ArchivedResource[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ArchivedResource[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ArchivedResourcesTable extends Table
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

        $this->setTable('archived_resources');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Domains', [
            'foreignKey' => 'domain_id',
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
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('picture')
            ->maxLength('picture', 255)
            ->allowEmptyString('picture');

        $validator
            ->scalar('picture_path')
            ->maxLength('picture_path', 255)
            ->allowEmptyString('picture_path');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->integer('domain_id')
            ->allowEmptyString('domain_id');

        $validator
            ->nonNegativeInteger('max_duration')
            ->allowEmptyString('max_duration');

        $validator
            ->boolean('archive')
            ->allowEmptyString('archive');

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
        $rules->add($rules->existsIn('domain_id', 'Domains'), ['errorField' => 'domain_id']);

        return $rules;
    }
}
