<?php
use Migrations\AbstractSeed;

/**
 * Patients seed.
 */
class PatientsSeed extends AbstractSeed
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
                'name' => 'Ayudante de santa',
                'sex' => 'male',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
                'breed_id' => 1,
                'customer_id' => 1,
            ],
        ];

        $table = $this->table('patients');
        $table->insert($data)->save();
    }
}
