<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Installment extends Model
{
    use HasFactory;

    public $table = 'installments';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'downpayment',
        'outstanding_balance',
        'monthly_installment',
        'installment_balance',
        'customer_id',
        'created_at',
        'updated_at',
        'created_by',
        'order_id',
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
