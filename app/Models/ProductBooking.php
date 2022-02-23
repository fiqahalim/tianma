<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class ProductBooking extends Model
{
    use HasFactory;

    public $table = 'product_bookings';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'booking_id',
        'customer_id',
        'created_at',
        'updated_at',
        'product_id',
        'booking_lots_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function bookingLots()
    {
        return $this->belongsToMany(BookingLot::class, 'booking_lots_id');
    }
}
