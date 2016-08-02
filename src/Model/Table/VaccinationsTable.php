<?php
namespace App\Model\Table;

use DateTime;
use App\Model\Entity\Vaccination;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Search\Manager;
use Cake\I18n\Date;

/**
 * Vaccinations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Vaccines
 * @property \Cake\ORM\Association\BelongsTo $Patients
 */
class VaccinationsTable extends Table
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

        $this->table('vaccinations');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Search');

        $this->searchManager()
            ->add('q', 'Search.Like', [
                'before' => true,
                'after' => true,
                'field' => [
                    $this->aliasField('annotations'),
                    'Vaccines.name',
                ]
            ]);

        $this->belongsTo('Vaccines', [
            'foreignKey' => 'vaccine_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Patients', [
            'foreignKey' => 'patient_id',
            'joinType' => 'INNER'
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->date('vaccination_date')
            ->requirePresence('vaccination_date', 'create')
            ->notEmpty('vaccination_date');

        $validator
            ->date('revaccination')
            ->requirePresence('revaccination', 'create')
            ->notEmpty('revaccination')
            ->add('revaccination', 'custom', [
                'rule' => [$this, 'isValidRevaccinationDate'],
                'message' => 'Fecha de revacunación debe ser mayor a la fecha de vacunación'
            ]);

        $validator
            ->allowEmpty('annotations')
            ->maxLength('annotations', 150, 'Las anotaciones deben tener como máximo 150 caracteres');

        $validator
            ->integer('vaccine_id')
            ->requirePresence('vaccine_id', 'create')
            ->notEmpty('vaccine_id');

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
        $rules->add($rules->existsIn(['vaccine_id'], 'Vaccines'));
        $rules->add($rules->existsIn(['patient_id'], 'Patients'));
        return $rules;
    }

    /**
     * Check if revaccination date is valid.
     *
     * @param \Cake\I18n\Time $value Current revaccination date
     * @param array $context
     */
    public function isValidRevaccinationDate($value, array $context)
    {
        $revaccination = Date::create($value['year'], $value['month'], $value['day']);
        $vaccination = Date::create($context['data']['vaccination_date']['year'], $context['data']['vaccination_date']['month'], $context['data']['vaccination_date']['day']);
        return $revaccination > $vaccination;
    }

    public function findExpiredToday(Query $query, array $options)
    {
        $query->where(['revaccination' => new DateTime(), 'revaccinated' => false]);
        return $query;
    }

    /**
     * Find total expired.
     * @param  \Cake\ORM\Query $query
     * @param  array $options
     * @return \Cake\ORM\Query
     */
    public function findTotalExpired(Query $query, array $options)
    {
        $query->where(['revaccination <=' => new DateTime(), 'revaccinated' => false]);
        return $query;
    }
}
