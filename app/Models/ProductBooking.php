<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class ProductBooking extends Model
{
    use HasFactory;

    public $table = 'product_bookings';

    protected $casts = [
        'seats' => 'array',
        // 'price' => 'array',
        // 'promo' => 'array',
        // 'maintenance' => 'array',
        // 'selling' => 'array',
        // 'point_value' => 'array',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'pnr_number',
        'seats',
        'ticket_count',
        'product_id',
        'customer_id',
        'created_by',
        'available', 'point_value', 'selling', 'maintenance', 'promo', 'price', 'book_locations_id'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function bookingLots()
    {
        return $this->belongsToMany(BookingLot::class, 'booking_lots_id');
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function orders()
    {
        return $this->belongsTo(Order::class, 'id', 'product_bookings_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopePending()
    {
        return $this->where('status', 2);
    }

    public function scopeBooked()
    {
        return $this->where('status', 1);
    }

    public function scopeRejected()
    {
        return $this->where('status', 0);
    }

    public function setSeatAttribute($value)
    {
        $this->attributes['seats'] = json_encode($value);
    }

    public function getSeatAttribute($value)
    {
        return $this->attributes['seats'] = json_decode($value);
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = json_encode($value);
    }

    public function getPriceAttribute($value)
    {
        return $this->attributes['price'] = json_decode($value);
    }

    public function setPromoAttribute($value)
    {
        $this->attributes['promo'] = json_encode($value);
    }

    public function getPromoAttribute($value)
    {
        return $this->attributes['promo'] = json_decode($value);
    }

    public function setMaintenanceAttribute($value)
    {
        $this->attributes['maintenance'] = json_encode($value);
    }

    public function getMaintenanceAttribute($value)
    {
        return $this->attributes['maintenance'] = json_decode($value);
    }

    public function setSellingAttribute($value)
    {
        $this->attributes['selling'] = json_encode($value);
    }

    public function getSellingAttribute($value)
    {
        return $this->attributes['selling'] = json_decode($value);
    }

    public function setPointValueAttribute($value)
    {
        $this->attributes['point_value'] = json_encode($value);
    }

    public function getPointValueAttribute($value)
    {
        return $this->attributes['point_value'] = json_decode($value);
    }
}
