<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Promotion extends Model
{
    use HasFactory;

    public $table = 'promotions';

    public const PROMO_TYPE_SELECT = [
        'Fixed'      => 'Fixed',
        'Percentage' => 'Percentage',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'promo_code', 'promo_type', 'promo_value',
        'cart_value', 'customer_id', 'created_at', 'updated_at',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
