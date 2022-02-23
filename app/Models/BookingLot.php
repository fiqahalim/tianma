<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class BookingLot extends Model
{
    use HasFactory;

    public $table = 'booking_lots';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'lot_no',
        'lot_booked',
        'created_at',
        'updated_at',
        'product_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function bookingSections()
    {
        return $this->belongsToMany(BookingSection::class);
    }
}
