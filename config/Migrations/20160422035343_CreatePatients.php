<?php
use Migrations\AbstractMigration;

class CreatePatients extends AbstractMigration
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
        $table = $this->table('patients');
        $table->addColumn('name', 'string', [
            'limit' => 50,
            'null' => false,
        ]);
        $table->addColumn('sex', 'enum', [
            'values' => ['male', 'female'],
            'null' => false,
        ]);
        $table->addColumn('birthday', 'date', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('coat', 'string', [
            'default' => null,
            'limit' => 30,
            'null' => true,
        ]);
        $table->addColumn('color', 'string', [
            'default' => null,
            'limit' => 30,
            'null' => true,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('breed_id', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('customer_id', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->addForeignKey('breed_id', 'breeds', 'id', [
            'delete' => 'NO_ACTION', 'delete' => 'NO_ACTION',
        ]);
        $table->addForeignKey('customer_id', 'customers', 'id', [
            'delete' => 'CASCADE', 'delete' => 'NO_ACTION',
        ]);
        $table->create();
    }
}
