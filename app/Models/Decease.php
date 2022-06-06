<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Decease extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use MultiTenantModelTrait;

    public $table = 'deceased_infos';

    protected $appends = [
        'document_file',
    ];

    public const GENDER_SELECT = [
        'Female'    => 'Female',
        'Male'      => 'Male',
    ];

    public const MARITAL_SELECT = [
        'Single'    => 'Single',
        'Married'   => 'Married',
        'Widowed'   => 'Widowed',
        'Divorced'  => 'Divorced',
        'Separated' => 'Separated',
        'Registered Partnership' => 'Registered Partnership',
    ];

    public const MAILING_FLAG = [
        'Yes' => 'Yes',
        'No'  => 'No',
    ];

    protected $dates = [
        'birth_date',
        'chinese_birth_date',
        'death_date',
        'bury_date',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'decease_name', 'decease_id_number', 'decease_chinese_name', 'decease_gender', 'decease_religion',
        'decease_maritial', 'decease_dialect', 'decease_national', 'decease_income', 'decease_occupation',
        'miling_flag', 'open_niche', 'undertaker', 'ref_no', 'bury_cert', 'cremation_cert', 'casket',
        'chinese_birth_date', 'birth_date', 'death_date', 'bury_date', 'grain_date', 'issue_postcode', 'issue_state',
        'issue_city', 'issue_address_1', 'issue_address_2', 'issue_country', 'funeral_postcode', 'funeral_state',
        'funeral_city', 'funeral_address_1', 'funeral_address_2', 'funeral_country', 'remark', 'item_elements',
        'lot_id', 'created_by',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function lotID()
    {
        return $this->belongsTo(ProductBooking::class, 'lot_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function setDeathDateAttribute($value)
    {
        $this->attributes['death_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getDeathDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setBuryDateAttribute($value)
    {
        $this->attributes['bury_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getBuryDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setGrainDateAttribute($value)
    {
        $this->attributes['grain_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getGrainDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setChineseBirthDateAttribute($value)
    {
        $this->attributes['chinese_birth_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getChineseDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function getBirthDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getDocumentFileAttribute()
    {
        return $this->getMedia('document_file');
    }
}
