<?php
use Migrations\AbstractMigration;

class CreateObservation extends AbstractMigration
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
        $table = $this->table('observations');
        $table->addColumn('title', 'string', [
            'limit' => 150,
            'null' => false,
        ]);
        $table->addColumn('content', 'text', [
            'null' => false,
        ]);
        $table->addColumn('type', 'string', [
            'limit' => 10,
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
        $table->addColumn('patient_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addForeignKey('patient_id', 'patients', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $table->create();
    }
}
