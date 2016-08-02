<?php
use Migrations\AbstractMigration;

class CreateBreeds extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('breeds');
        $table->addColumn('name', 'string', [
            'limit' => 50,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('species_id', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->addForeignKey('species_id', 'species', 'id', [
            'delete' => 'NO_ACTION', 'update' => 'NO_ACTION',
        ]);
        $table->addIndex(['name', 'species_id'], ['unique' => true]);
        $table->create();
    }
}
