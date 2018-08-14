<?php


use \VoucherPool\Migration\Migration;

class VoucherRecipient extends Migration
{
    public function up()  {
        $table = $this->table('voucher_recipient', ['id' => false, 'primary_key' => ['id']]);
        $table->addColumn('id', 'integer')
              ->addColumn('voucher_id', 'integer')
              ->addColumn('recepient_id', 'integer')
              ->addColumn('created_at', 'datetime')
              ->save();
    }
    public function down()  {
        $this->schema->drop('voucher_recipient');
    }
}
