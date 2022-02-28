<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const ORDER_STATUS_SELECT = [
        'Pending'    => 'Pending',
        'In Progress' => 'In Progress',
        'Completed'  => 'Completed',
        'Rejected'   => 'Rejected',
    ];

    public $table = 'orders';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'ref_no',
        'amount',
        'order_status',
        'approved',
        'customer_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
        'created_by',
        'product_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
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

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function installments()
    {
        return $this->belongsTo(Installment::class, 'id', 'order_id');
    }

    public function fullPayments()
    {
        return $this->belongsTo(Transaction::class, 'id', 'order_id');
    }
}
