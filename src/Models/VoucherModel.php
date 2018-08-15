<?php
namespace VoucherPool\Models;

use Illuminate\Database\Eloquent\Model;

class VoucherModel extends Model {
    protected $table = 'vouchers';

    protected $fillable = [
        'code', 'discount', 'is_used', 'used_at', 'expire_at'
    ];
}