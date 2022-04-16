<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public $table = 'transactions';

    protected $dates = [
        'transaction_date',
    ];

    public const STATUS_SELECT = [
        'Paid'   => 'Paid',
        'Unpaid' => 'Unpaid',
    ];

    protected $fillable = [
        'amount',
        'trans_no',
        'description',
        'status',
        'balance',
        'transaction_date',
        'order_id',
        'created_by',
        'customer_id',
        'installment_id',
    ];

    public function customer()
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

    public function installments()
    {
        return $this->belongsTo(Installment::class, 'installment_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getMonthAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setMonthAttribute($value)
    {
        $this->attributes['month'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function scopeFilterDates($query)
    {
        $date = explode(" - ", request()->input('from-to', ""));

        if(count($date) != 2)
        {
            $date = [now()->subDays(29)->format("Y-m-d"), now()->format("Y-m-d")];
        }

        return $query->whereBetween('transaction_date', $date);
    }
}
