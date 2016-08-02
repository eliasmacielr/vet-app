<?php
use Migrations\AbstractMigration;

class CreateSystemLogs extends AbstractMigration
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
        $table = $this->table('system_logs');
        $table->addColumn('action', 'enum', [
            'values' => ['add', 'edit', 'delete'],
            'null' => false,
        ]);
        $table->addColumn('content', 'enum', [
            'values' => ['locations', 'customers', 'patients', 'species',
                'breeds', 'vaccinations', 'vaccines', 'system_logs'],
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
