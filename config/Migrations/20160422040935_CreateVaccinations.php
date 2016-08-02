<?php
use Migrations\AbstractMigration;

class CreateVaccinations extends AbstractMigration
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
        $table = $this->table('vaccinations');
        $table->addColumn('vaccination_date', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('revaccination', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('revaccinated', 'boolean', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('annotations', 'string', [
            'default' => null,
            'limit' => 150,
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
        $table->addColumn('vaccine_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('patient_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addForeignKey('vaccine_id', 'vaccines', 'id', [
            'delete' => 'NO_ACTION',
            'update' => 'NO_ACTION',
        ]);
        $table->addForeignKey('patient_id', 'patients', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $table->create();
    }
}
