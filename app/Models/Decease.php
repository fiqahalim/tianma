<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decease extends Model
{
    use HasFactory;

    public $table = 'deceased_infos';

    public const GENDER_SELECT = [
        'Female'    => 'Female',
        'Male'      => 'Male',
    ];

    protected $dates = [
        'birth_date',
        'chinese_birth_date',
        'death_date',
        'grain_date',
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
}
