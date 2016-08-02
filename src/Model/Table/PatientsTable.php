<?php
namespace App\Model\Table;

use App\Model\Entity\Patient;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Search\Manager;

/**
 * Patients Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Breeds
 * @property \Cake\ORM\Association\BelongsTo $Customers
 * @property \Cake\ORM\Association\HasMany $Observations
 * @property \Cake\ORM\Association\HasMany $Vaccinations
 */
class PatientsTable extends Table
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

        $this->table('patients');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Search');

        $this->searchManager()
            ->add('q', 'Search.Like', [
                'before' => true,
                'after' => true,
                'field' => [
                    $this->aliasField('name'),
                    'Breeds.name',
                    'Customers.name',
                    'Customers.last_name',
                ]
            ]);

        $this->belongsTo('Breeds', [
            'foreignKey' => 'breed_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Observations', [
            'foreignKey' => 'patient_id'
        ]);
        $this->hasMany('Vaccinations', [
            'foreignKey' => 'patient_id'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->maxLength('name', 50, 'El nombre debe tener como máximo 50 caracteres');

        $validator
            ->requirePresence('sex', 'create')
            ->notEmpty('sex');

        $validator
            ->date('birthday', ['ymd'], 'La fecha es incorrecta')
            ->allowEmpty('birthday');

        $validator
            ->allowEmpty('coat')
            ->maxLength('coat', 30, 'El pelaje debe tener como máximo 30 caracteres');

        $validator
            ->allowEmpty('color')
            ->maxLength('color', 30, 'El color debe tener como máximo 30 caracteres');

        $validator
            ->requirePresence('breed_id', 'create')
            ->notEmpty('breed_id', ['message' => 'Debe seleccionar la raza']);

        $validator
            ->requirePresence('customer_id', 'create')
            ->notEmpty('customer_id', ['message' => 'Debe seleccionar el propietario']);

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
        $rules->add($rules->existsIn(['breed_id'], 'Breeds'));
        $rules->add($rules->existsIn(['customer_id'], 'Customers'));
        return $rules;
    }
}
