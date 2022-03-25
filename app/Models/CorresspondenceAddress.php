<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorresspondenceAddress extends Model
{
    use HasFactory;

    public $table = 'correspondence_addresses';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'curpostcode',
        'curstate',
        'curcity',
        'curaddress_1',
        'curaddress_2',
        'curnationality',
        'curcountry',
        'created_at',
        'updated_at',
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class);
    }
}
