<?php
use Migrations\AbstractSeed;

/**
 * Customers seed.
 */
class CustomersSeed extends AbstractSeed
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
        $locations = $this->fetchRow('SELECT * FROM locations');
        $data = [
            [
                'name' => 'Homero',
                'last_name' => 'Simpson',
                'email' => 'amantedelacomida43@aol.com',
                'phone' => '09876543',
                'address' => 'Siempre Viva',
                'location_id' => $locations['id'],
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Marge',
                'last_name' => 'Simpson',
                'phone' => '09876543',
                'phone_other' => '021213123',
                'address' => 'Siempre Viva',
                'location_id' => $locations['id'],
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ]
        ];

        $table = $this->table('customers');
        $table->insert($data)->save();
    }
}
