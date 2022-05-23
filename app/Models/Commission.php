<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commission extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'commissions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'mo_overriding_comm',
        'mo_spin_off',
        'user_id',
        'order_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
        'credit_amount',
        'debit_amount',
        'balance_amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function installments()
    {
        return $this->belongsTo(Installment::class);
    }

    public function fullPayments()
    {
        return $this->belongsTo(Transaction::class, 'id', 'order_id');
    }
}
