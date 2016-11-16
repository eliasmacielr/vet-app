<?php
use Migrations\AbstractSeed;

/**
 * Vaccinations seed.
 */
class VaccinationsSeed extends AbstractSeed
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
                'vaccination_date' => date('Y-m-d H:i:s'),
                'revaccination' => date('Y-m-d H:i:s', strtotime("+15 days")),
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
                'vaccine_id' => 1,
                'patient_id' => 1,
            ],
        ];

        $table = $this->table('vaccinations');
        $table->insert($data)->save();
    }
}
