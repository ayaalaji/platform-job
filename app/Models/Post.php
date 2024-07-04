<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
            'title',
            'job_role',
            'career_level',
            'experience_needed',
            'job_type',
            'key_skills',
            'address',
            'company_id',
    ];
    public function company(){
        return $this->belongsTo(Company::class);
    }
}
