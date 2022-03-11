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
        'contact_person_name',
        'contact_person_no',
        'id_type',
        'id_number',
        'email',
        'relationships'
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
