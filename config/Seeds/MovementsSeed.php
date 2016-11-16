<?php
use Migrations\AbstractSeed;

/**
 * Movements seed.
 */
class MovementsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'concept' => 'Vacuna séxtuple',
                'type' => 'income',
                'amount' => 60000,
                'movement_date' => date('Y-m-d H:i:s'),
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'concept' => 'Gasto',
                'type' => 'outcome',
                'amount' => 20000,
                'movement_date' => date('Y-m-d H:i:s'),
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('movements');
        $table->insert($data)->save();
    }
}
