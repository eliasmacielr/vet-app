<?php
use Migrations\AbstractSeed;

/**
 * Observations seed.
 */
class ObservationsSeed extends AbstractSeed
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
                'title' => 'Primera atención',
                'content' => '<p>Primera Atención</p>',
                'type' => 'info',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
                'patient_id' => 1,
            ],
        ];

        $table = $this->table('observations');
        $table->insert($data)->save();
    }
}
