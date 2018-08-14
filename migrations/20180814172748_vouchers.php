<?php


use \VoucherPool\Migration\Migration;

class Vouchers extends Migration
{
    public function up()  {
        $table = $this->table('vouchers', ['id' => false, 'primary_key' => ['id']]);
        $table->addColumn('id', 'integer')
              ->addColumn('code', 'string', ['limit' => 8])
              ->addColumn('discount', 'integer', ['limit' => 3])
              ->addColumn('is_used', 'integer', ['limit' => 1])
              ->addColumn('used_at', 'datetime')
              ->addColumn('created_at', 'datetime')
              ->addColumn('expire_at', 'datetime', ['null' => true])
              ->save();
    }
    public function down()  {
        $this->schema->drop('vouchers');
    }
}
