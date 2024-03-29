<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cog extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'scholar_id',
        'semester',
        'cogdetails_id',
        'failnum',
        'cog_status',
        'acadyear',
        'startyear',
        'endyear',
        'date_uploaded',
        'scholarshipstatus',
        'prospectus_details',
        'draft'
    ];

    public function cogdetails()
    {
        return $this->hasMany(Cogdetails::class);
    }
}
