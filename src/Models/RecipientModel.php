<?php
namespace VoucherPool\Models;

use Illuminate\Database\Eloquent\Model;

class RecipientModel extends Model {
    protected $table = 'recipient';

    protected $fillable = [
        'name', 'email'
    ];
}