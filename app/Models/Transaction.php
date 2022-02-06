<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public $table = 'transactions';

    public const MODE_SELECT = [
        'installment'   => 'Installment',
        'full_payment'  => 'Full Payment',
    ];

    protected $dates = [
        'transaction_date',
    ];

    protected $fillable = [
        'mode',
        'amount',
        'transaction_date',
        'downpayment',
        'outstanding_balance',
        'installment',
        'installment_balance',
        'order_id',
        'created_by',
        'customer_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
