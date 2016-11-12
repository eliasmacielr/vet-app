<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Movements Model.
 */
class MovementsTable extends Table
{
    /**
     * Initialize method.
     *
     * @param array $config The configuration for the Table
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('movements');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance
     *
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('concept', 'create')
            ->notEmpty('concept')
            ->maxLength('concept', 50, 'El concepto debe tener como máximo 50 caracteres');

        $validator
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->integer('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

        return $validator;
    }

    /**
     * Make a query to search movements in a specific month of a year.
     *
     * @param \Cake\ORM\Query $query
     * @param array           $options
     *
     * @return \Cake\ORM\Query
     */
    public function findSearchByMonth(Query $query, array $options)
    {
        return $query->where(
            $query->newExpr()
                ->add('EXTRACT(MONTH FROM '.$this->aliasField('movement_date').') = :month'))
        ->bind(':month', $options['date']->format('m'), 'integer');
    }

    /**
     * Make a query to search movements in a specific a year.
     *
     * @param \Cake\ORM\Query $query
     * @param array           $options
     *
     * @return \Cake\ORM\Query
     */
    public function findSearchByYear(Query $query, array $options)
    {
        return $query->where(
            $query->newExpr()
                ->add('EXTRACT(YEAR FROM '.$this->aliasField('movement_date').') = :year'))
        ->bind(':year', $options['date']->format('Y'), 'integer');
    }

    /**
     * Calculate total sum of all movements.
     *
     * @param \Cake\ORM\Query $query
     * @param array           $options
     *
     * @return \Cake\ORM\Query
     */
    public function findTotalSum(Query $query, array $options)
    {
        return $query->select([
            'income' => $query->func()->sum($query->newExpr()->add("CASE WHEN type = 'income' THEN Movements.amount ELSE 0 END")),
            'outcome' => $query->func()->sum($query->newExpr()->add("CASE WHEN type = 'outcome' THEN Movements.amount ELSE 0 END")),
        ]);
    }
    /**
     * Calculate year resume sum by month.
     *
     * @param Query $query
     * @param array $options
     *
     * @return \Cake\ORM\Query
     */
    public function findYearResume(Query $query, array $options)
    {
        $query = $this->findSearchByYear($query, $options);

        return $query->select([
            'jan_income' => $query->func()->sum($query->newExpr()->add("CASE WHEN (type = 'income' AND EXTRACT(MONTH FROM Movements.movement_date) = 1) THEN Movements.amount ELSE 0 END")),
            'jan_outcome' => $query->func()->sum($query->newExpr()->add("CASE WHEN (type = 'outcome' AND EXTRACT(MONTH FROM Movements.movement_date) = 1) THEN Movements.amount ELSE 0 END")),
            'feb_income' => $query->func()->sum($query->newExpr()->add("CASE WHEN (type = 'income' AND EXTRACT(MONTH FROM Movements.movement_date) = 2) THEN Movements.amount ELSE 0 END")),
            'feb_outcome' => $query->func()->sum($query->newExpr()->add("CASE WHEN (type = 'outcome' AND EXTRACT(MONTH FROM Movements.movement_date) = 2) THEN Movements.amount ELSE 0 END")),
            'mar_income' => $query->func()->sum($query->newExpr()->add("CASE WHEN (type = 'income' AND EXTRACT(MONTH FROM Movements.movement_date) = 3) THEN Movements.amount ELSE 0 END")),
            'mar_outcome' => $query->func()->sum($query->newExpr()->add("CASE WHEN (type = 'outcome' AND EXTRACT(MONTH FROM Movements.movement_date) = 3) THEN Movements.amount ELSE 0 END")),
            'apr_income' => $query->func()->sum($query->newExpr()->add("CASE WHEN (type = 'income' AND EXTRACT(MONTH FROM Movements.movement_date) = 4) THEN Movements.amount ELSE 0 END")),
            'apr_outcome' => $query->func()->sum($query->newExpr()->add("CASE WHEN (type = 'outcome' AND EXTRACT(MONTH FROM Movements.movement_date) = 4) THEN Movements.amount ELSE 0 END")),
            'may_income' => $query->func()->sum($query->newExpr()->add("CASE WHEN (type = 'income' AND EXTRACT(MONTH FROM Movements.movement_date) = 5) THEN Movements.amount ELSE 0 END")),
            'may_outcome' => $query->func()->sum($query->newExpr()->add("CASE WHEN (type = 'outcome' AND EXTRACT(MONTH FROM Movements.movement_date) = 5) THEN Movements.amount ELSE 0 END")),
            'june_income' => $query->func()->sum($query->newExpr()->add("CASE WHEN (type = 'income' AND EXTRACT(MONTH FROM Movements.movement_date) = 6) THEN Movements.amount ELSE 0 END")),
            'june_outcome' => $query->func()->sum($query->newExpr()->add("CASE WHEN (type = 'outcome' AND EXTRACT(MONTH FROM Movements.movement_date) = 6) THEN Movements.amount ELSE 0 END")),
            'july_income' => $query->func()->sum($query->newExpr()->add("CASE WHEN (type = 'income' AND EXTRACT(MONTH FROM Movements.movement_date) = 7) THEN Movements.amount ELSE 0 END")),
            'july_outcome' => $query->func()->sum($query->newExpr()->add("CASE WHEN (type = 'outcome' AND EXTRACT(MONTH FROM Movements.movement_date) = 7) THEN Movements.amount ELSE 0 END")),
            'aug_income' => $query->func()->sum($query->newExpr()->add("CASE WHEN (type = 'income' AND EXTRACT(MONTH FROM Movements.movement_date) = 8) THEN Movements.amount ELSE 0 END")),
            'aug_outcome' => $query->func()->sum($query->newExpr()->add("CASE WHEN (type = 'outcome' AND EXTRACT(MONTH FROM Movements.movement_date) = 8) THEN Movements.amount ELSE 0 END")),
            'sept_income' => $query->func()->sum($query->newExpr()->add("CASE WHEN (type = 'income' AND EXTRACT(MONTH FROM Movements.movement_date) = 9) THEN Movements.amount ELSE 0 END")),
            'sept_outcome' => $query->func()->sum($query->newExpr()->add("CASE WHEN (type = 'outcome' AND EXTRACT(MONTH FROM Movements.movement_date) = 9) THEN Movements.amount ELSE 0 END")),
            'oct_income' => $query->func()->sum($query->newExpr()->add("CASE WHEN (type = 'income' AND EXTRACT(MONTH FROM Movements.movement_date) = 10) THEN Movements.amount ELSE 0 END")),
            'oct_outcome' => $query->func()->sum($query->newExpr()->add("CASE WHEN (type = 'outcome' AND EXTRACT(MONTH FROM Movements.movement_date) = 10) THEN Movements.amount ELSE 0 END")),
            'nov_income' => $query->func()->sum($query->newExpr()->add("CASE WHEN (type = 'income' AND EXTRACT(MONTH FROM Movements.movement_date) = 11) THEN Movements.amount ELSE 0 END")),
            'nov_outcome' => $query->func()->sum($query->newExpr()->add("CASE WHEN (type = 'outcome' AND EXTRACT(MONTH FROM Movements.movement_date) = 11) THEN Movements.amount ELSE 0 END")),
            'dec_income' => $query->func()->sum($query->newExpr()->add("CASE WHEN (type = 'income' AND EXTRACT(MONTH FROM Movements.movement_date) = 12) THEN Movements.amount ELSE 0 END")),
            'dec_outcome' => $query->func()->sum($query->newExpr()->add("CASE WHEN (type = 'outcome' AND EXTRACT(MONTH FROM Movements.movement_date) = 12) THEN Movements.amount ELSE 0 END")),
            'total_income' => $query->func()->sum($query->newExpr()->add("CASE WHEN type = 'income' THEN Movements.amount ELSE 0 END")),
            'total_outcome' => $query->func()->sum($query->newExpr()->add("CASE WHEN type = 'outcome' THEN Movements.amount ELSE 0 END")),
        ]);
    }

    /**
     * Calculate sum of movements by date.
     *
     * @param \Cake\ORM\Query $query
     * @param array           $options
     *
     * @return \Cake\ORM\Query
     */
    public function findTotalSumByDate(Query $query, array $options)
    {
        $query = $this->findTotalSum($query, $options);

        return $query->where(['movement_date' => $options['date']]);
    }

    /**
     * Calculate sum of movements by a month.
     *
     * @param \Cake\ORM\Query $query
     * @param array           $options
     *
     * @return \Cake\ORM\Query
     */
    public function findTotalSumByMonth(Query $query, array $options)
    {
        $query = $this->findTotalSum($query, $options);
        $query = $this->findSearchByMonth($query, $options);
        $query = $this->findSearchByYear($query, $options);

        return $query;
    }

    /**
     * Calculate sum of movements by a year.
     *
     * @param \Cake\ORM\Query $query
     * @param array           $options
     *
     * @return \Cake\ORM\Query
     */
    public function findTotalSumByYear(Query $query, array $options)
    {
        $query = $this->findTotalSum($query, $options);
        $query = $this->findSearchByYear($query, $options);

        return $query;
    }
}
