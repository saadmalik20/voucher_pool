<?php


use \VoucherPool\Migration\Migration;

class Recipient extends Migration
{
    public function up()  {
        $table = $this->table('recipient', ['id' => false, 'primary_key' => ['id']]);
        $table->addColumn('id', 'integer')
              ->addColumn('name', 'string', ['limit' => 20])
              ->addColumn('email', 'string', ['limit' => 50])
              ->addColumn('created_at', 'datetime')
              ->addIndex(['email'], ['unique' => true])
              ->save();
    }
    public function down()  {
        $this->schema->drop('recipient');
    }
}
