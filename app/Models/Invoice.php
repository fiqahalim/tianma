<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public $table = 'invoices';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'doc_no',
        'doc_date',
        'debtor_code',
        'journal_type',
        'display_term',
        'sales_agent',
        'description',
        'currency_code',
        'currency_rate',
        'ref_no_2',
        'note',
        'inclusive_tax',
        'acc_no',
        'to_account_rate',
        'detail_description',
        'proj_no',
        'dept_no',
        'tax_type',
        'taxable_amount',
        'tax_adjustment',
        'amount',
    ];
}
