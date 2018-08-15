<?php


use \VoucherPool\Migration\Migration;

class Recipient extends Migration
{
    public function up()  {
        $table = $this->table('recipient', ['primary_key' => ['id']]);
        $table->addColumn('name', 'string', ['limit' => 20])
              ->addColumn('email', 'string', ['limit' => 50])
              ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
              ->addColumn('updated_at', 'timestamp')
              ->addIndex(['email'], ['unique' => true])
              ->save();
    }
    public function down()  {
        $this->schema->drop('recipient');
    }
}
