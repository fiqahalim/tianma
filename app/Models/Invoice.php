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
        'order_id'
    ];

    public function installments()
    {
        return $this->belongsTo(Installment::class, 'id', 'order_id');
    }

    public function transactions()
    {
        return $this->belongsTo(Transaction::class, 'id', 'order_id');
    }

    public function fullPayments()
    {
        return $this->belongsTo(Transaction::class, 'id', 'order_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function commissions()
    {
        return $this->belongsTo(Commission::class, 'id', 'order_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
