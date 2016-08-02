<?php
namespace App\Model\Table;

use App\Model\Entity\Breed;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Search\Manager;

/**
 * Breeds Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Species
 * @property \Cake\ORM\Association\HasMany $Patients
 */
class BreedsTable extends Table
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

        $this->table('breeds');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Search');

        $this->belongsTo('Species', [
            'foreignKey' => 'species_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Patients', [
            'foreignKey' => 'breed_id'
        ]);

        $this->searchManager()
            ->add('q', 'Search.Like', [
                'before' => true,
                'after' => true,
                'field' => [$this->aliasField('name'), $this->Species->aliasField('name')]
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
            ->maxLength('name', 50, 'El nombre debe tener como máximo 50 caracteres')
            ->add('name', 'unique', ['rule' => ['validateUnique', ['scope' => 'species_id']], 'provider' => 'table', 'message' => 'Ya existe otra raza con ese nombre']);

        $validator
            ->requirePresence('species_id', 'create')
            ->notEmpty('species_id');
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
        $rules->add($rules->existsIn(['species_id'], 'Species'));
        return $rules;
    }
}
