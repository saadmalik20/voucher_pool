<?php
namespace VoucherPool\Models;

use Illuminate\Database\Eloquent\Model;

class VoucherRecipientModel extends Model {
    protected $table = 'voucher_recipient';

    protected $fillable = [
        'voucher_id', 'recipient_id'
    ];
}