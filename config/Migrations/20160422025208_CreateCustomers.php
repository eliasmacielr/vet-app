<?php
use Migrations\AbstractMigration;

class CreateCustomers extends AbstractMigration
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
        $table = $this->table('customers');
        $table->addColumn('name', 'string', [
            'limit' => 50,
            'null' => false,
        ]);
        $table->addColumn('last_name', 'string', [
            'limit' => 50,
            'null' => false,
        ]);
        $table->addColumn('email', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('phone', 'string', [
            'limit' => 20,
            'null' => false,
        ]);
        $table->addColumn('phone_other', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => true,
        ]);
        $table->addColumn('address', 'string', [
            'limit' => 100,
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
        $table->addColumn('location_id', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->addForeignKey('location_id', 'locations', 'id', [
            'delete' => 'NO_ACTION', 'update' => 'NO_ACTION'
        ]);
        $table->create();
    }
}
