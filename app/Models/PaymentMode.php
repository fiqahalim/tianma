<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMode extends Model
{
    use HasFactory;

    public $table = 'payment_modes';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'payment_name',
        'mode',
        'payment_ status',
    ];

    public function setPaymentNameAttribute($value)
    {
        $this->attributes['payment_name'] = json_encode($value);
    }

    public function getPaymentNameAttribute($value)
    {
        return $this->attributes['payment_name'] = json_decode($value);
    }
}
