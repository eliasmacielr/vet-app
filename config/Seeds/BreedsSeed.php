<?php
use Migrations\AbstractSeed;

/**
 * Breeds seed.
 */
class BreedsSeed extends AbstractSeed
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
                'name' => 'Galgo',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
                'species_id' => 1,
            ],
            [
                'name' => 'Caniche',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
                'species_id' => 1,
            ],
        ];

        $table = $this->table('breeds');
        $table->insert($data)->save();
    }
}
