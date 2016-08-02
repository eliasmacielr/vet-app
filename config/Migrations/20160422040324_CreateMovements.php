<?php
use Migrations\AbstractMigration;

class CreateMovements extends AbstractMigration
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
        $table = $this->table('movements');
        $table->addColumn('concept', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => false,
        ]);
        $table->addColumn('type', 'enum', [
            'values' => ['income', 'outcome'],
            'null' => false,
        ]);
        $table->addColumn('amount', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('movement_date', 'date', [
            'default' => null,
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
        $table->create();
    }
}
