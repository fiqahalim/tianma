<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class BookingSection extends Model
{
    use HasFactory;

    public $table = 'booking_sections';

    protected $guarded = ['id'];

    public const SECTION_SELECT = [
        'DA' => 'DA',
        'DB' => 'DB',
        'DC' => 'DC',
        'DD' => 'DD',
    ];

    protected $casts = [
        'deck_seats' => 'object',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'section',
        'created_at',
        'updated_at',
        'product_id',
        'product_bookings_id',
        'booking_lots_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class);
    }

    public function levels()
    {
        return $this->belongsToMany(Level::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productBookings()
    {
        return $this->belongsTo(ProductBooking::class, 'product_bookings_id');
    }

    public function bookingLots()
    {
        return $this->belongsToMany(BookingLot::class);
    }

    public function scopeActive()
    {
        return $this->where('status', 1);
    }
}
