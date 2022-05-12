<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public $table = 'payments';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'doc_no',
        'doc_date',
        'debtor_code',
        'description',
        'proj_no',
        'dept_no',
        'currency_code',
        'to_home_rate',
        'to_debtor_rate',
        'note',
        'payment_method',
        'cheque_no',
        'payment_amount',
        'bank_charge',
        'to_bank_rate',
        'payment_by',
        'float_day',
        'isRCHQ',
        'rchq_date',
        'knock_off_doc_type',
        'knock_off_doc_no',
        'knock_off_amount',
    ];
}
