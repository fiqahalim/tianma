<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const ID_TYPE_SELECT = [
        'Passport' => 'Passport',
        'NRIC'     => 'NRIC',
    ];

    public const MODE_SELECT = [
        'Installment'   => 'Installment',
        'Full Payment'  => 'Full Payment',
    ];

    public const GENDER_SELECT = [
        'Female'    => 'Female',
        'Male'      => 'Male',
    ];

    public $table = 'customers';

    protected $dates = [
        'birth_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'full_name',
        'id_type',
        'id_number',
        'email',
        'mobile',
        'gender',
        'contact_person_name',
        'contact_person_no',
        'cperson_id_number',
        'birth_date',
        'postcode',
        'state',
        'city',
        'address_1',
        'address_2',
        'nationality',
        'country',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'mode',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getBirthDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function installments()
    {
        return $this->belongsTo(Installment::class);
    }

    public function fullPayments()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function contactPersons()
    {
        return $this->hasMany(ContactPerson::class);
    }

    public function correspondenceAddress()
    {
        return $this->belongsTo(CorresspondenceAddress::class, 'id', 'customer_id');
    }

    public function payments()
    {
        return $this->hasMany(PaymentMode::class);
    }
}
