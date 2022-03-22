<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddOnProduct extends Model
{
    use HasFactory;

    public $table = 'add_on_products';

    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
    ];
}
