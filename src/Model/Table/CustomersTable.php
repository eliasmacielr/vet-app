<?php
namespace App\Model\Table;

use App\Model\Entity\Customer;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Search\Manager;

/**
 * Customers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Locations
 * @property \Cake\ORM\Association\HasMany $Patients
 */
class CustomersTable extends Table
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

        $this->table('customers');
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
                    $this->aliasField('last_name'),
                    $this->aliasField('phone'),
                ]
            ]);

        $this->belongsTo('Locations', [
            'foreignKey' => 'location_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Patients', [
            'foreignKey' => 'customer_id'
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
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name')
            ->maxLength('last_name', 50, 'El apellido debe tener como máximo 50 caracteres');

        $validator
            ->email('email', false, 'El email ingresado es inválido')
            ->allowEmpty('email')
            ->maxLength('email', 255, 'El email debe tener como máximo 255 caracteres');

        $validator
            ->requirePresence('phone', 'create')
            ->notEmpty('phone')
            ->integer('phone', 'El teléfono ingresado es inválido')
            ->maxLength('phone', 20, 'El teléfono debe tener como máximo 20 caracteres');

        $validator
            ->allowEmpty('phone_other')
            ->integer('phone_other', 'El teléfono ingresado es inválido')
            ->maxLength('phone_other', 20, 'El teléfono debe tener como máximo 20 caracteres');

        $validator
            ->requirePresence('address', 'create')
            ->notEmpty('address')
            ->maxLength('address', 100, 'La dirección debe tener como máximo 100 caracteres');

        $validator
            ->requirePresence('location_id', 'create')
            ->notEmpty('location_id', 'Debe seleccionar una ciudad');

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
        $rules->add($rules->existsIn(['location_id'], 'Locations'));
        return $rules;
    }
}
