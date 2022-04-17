<?php

namespace App\Models;

use \DateTimeInterface;
use App\Notifications\VerifyUserNotification;
use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    use HasFactory;

    public const ID_TYPE_SELECT = [
        'NRIC'     => 'NRIC',
        'Passport' => 'Passport',
    ];

    public $table = 'users';

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $dates = [
        'verified_at',
        'email_verified_at',
        'passport_issue_date',
        'passport_expiry_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name', 'id_type', 'id_number', 'email', 'username', 'approved',
        'verified', 'verified_at', 'verification_token', 'password', 'contact_no',
        'agent_code', 'agency_code', 'team_id', 'parent_id', 'email_verified_at',
        'remember_token', 'passport_issue_date', 'passport_expiry_date',
        'address_1', 'address_2', 'postcode', 'state', 'city', 'country', 'nationality',
        'created_at', 'updated_at', 'deleted_at', 'avatar', 'ranking_id',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (User $user) {
            if (auth()->check()) {
                $user->verified = 1;
                $user->verified_at = Carbon::now()->format(config('panel.date_format') . ' ' . config('panel.time_format'));
                $user->save();
            } elseif (!$user->verification_token) {
                $token = Str::random(64);
                $usedToken = User::where('verification_token', $token)->first();

                while ($usedToken) {
                    $token = Str::random(64);
                    $usedToken = User::where('verification_token', $token)->first();
                }

                $user->verification_token = $token;
                $user->save();

                $registrationRole = config('panel.registration_default_role');
                if (!$user->roles()->get()->contains($registrationRole)) {
                    $user->roles()->attach($registrationRole);
                }

                $user->notify(new VerifyUserNotification($user));
            }
        });
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function userUserAlerts()
    {
        return $this->belongsToMany(UserAlert::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function rankings()
    {
        return $this->belongsTo(Ranking::class, 'ranking_id');
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'agent_code');
    }

    public function childUsers()
    {
        return $this->hasMany(User::class, 'parent_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'id', 'created_by');
    }

    public function customer()
    {
        return $this->hasMany(Customer::class);
    }

    public function commissions()
    {
        return $this->belongsTo(Commission::class, 'id', 'user_id');
    }

    public function getVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setVerifiedAtAttribute($value)
    {
        $this->attributes['verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }


    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getPassportIssueDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setPassportIssueDateAttribute($value)
    {
        $this->attributes['passport_issue_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getPassportExpiryDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setPassportExpiryDateAttribute($value)
    {
        $this->attributes['passport_expiry_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
