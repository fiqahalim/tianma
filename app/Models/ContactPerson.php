<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class ContactPerson extends Model
{
    use HasFactory;

    public $table = 'contact_persons';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'cperson_name',
        'cperson_no',
        'cid_type',
        'cid_number',
        'cemail',
        'relationships',
        'customer_id',
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
