<?php
use Migrations\AbstractSeed;
use Cake\Auth\DefaultPasswordHasher;

/**
 * UsersSeed seed.
 */
class UsersSeed extends AbstractSeed
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
        $hasher = new DefaultPasswordHasher();
        $data = [
            [
                'email' => 'admin@vetapp.com',
                'name' => 'Admin',
                'last_name' => 'Admin',
                'password' => $hasher->hash('secretpass098'),
                'active' => true,
                'group_name' => 'admin',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'email' => 'staff@vetapp.com',
                'name' => 'Staff',
                'last_name' => 'Admin',
                'password' => $hasher->hash('staff098'),
                'active' => true,
                'group_name' => 'staff',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
