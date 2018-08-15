<?php


use \VoucherPool\Migration\Migration;

class Vouchers extends Migration
{
    public function up()  {
        $table = $this->table('vouchers', ['primary_key' => ['id']]);
        $table->addColumn('code', 'string', ['limit' => 8])
            ->addColumn('discount', 'integer', ['limit' => 3])
            ->addColumn('is_used', 'integer', ['limit' => 1, 'default' => 0])
            ->addColumn('used_at', 'timestamp', ['null' => true])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp')
            ->addColumn('expire_at', 'date', ['null' => true])
        ->save();
    }
    public function down()  {
        $this->schema->drop('vouchers');
    }
}
