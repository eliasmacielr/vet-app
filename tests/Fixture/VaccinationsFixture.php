<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VaccinationsFixture
 *
 */
class VaccinationsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'vaccination_date' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'revaccination' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'revaccinated' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'annotations' => ['type' => 'string', 'length' => 150, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'vaccine_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'patient_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'vaccine_id' => ['type' => 'index', 'columns' => ['vaccine_id'], 'length' => []],
            'patient_id' => ['type' => 'index', 'columns' => ['patient_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'vaccinations_ibfk_1' => ['type' => 'foreign', 'columns' => ['vaccine_id'], 'references' => ['vaccines', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'vaccinations_ibfk_2' => ['type' => 'foreign', 'columns' => ['patient_id'], 'references' => ['patients', 'id'], 'update' => 'noAction', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'vaccination_date' => '2016-07-03',
            'revaccination' => '2016-07-03',
            'revaccinated' => 1,
            'annotations' => 'Lorem ipsum dolor sit amet',
            'created' => '2016-07-03 18:50:28',
            'modified' => '2016-07-03 18:50:28',
            'vaccine_id' => 1,
            'patient_id' => 1
        ],
    ];
}
