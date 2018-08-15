<?php


use \VoucherPool\Migration\Migration;

class VoucherRecipient extends Migration
{
    public function up()  {
        $table = $this->table('voucher_recipient', ['primary_key' => ['id']]);
        $table->addColumn('voucher_id', 'integer')
              ->addColumn('recipient_id', 'integer')
              ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
              ->addColumn('updated_at', 'timestamp')
              ->save();
    }
    public function down()  {
        $this->schema->drop('voucher_recipient');
    }
}
