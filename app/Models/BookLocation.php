<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class BookLocation extends Model
{
    use HasFactory;

    public $table = 'book_locations';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'location',
        'product_type',
        'build_type',
        'level',
        'created_at',
        'updated_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
