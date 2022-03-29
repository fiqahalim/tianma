<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMonthly extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_SELECT = [
        'Paid'   => 'Paid',
        'Unpaid' => 'Unpaid',
    ];

    public $table = 'payment_monthlies';

    protected $dates = [
        'month',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'month',
        'paid_amount',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getMonthAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setMonthAttribute($value)
    {
        $this->attributes['month'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
