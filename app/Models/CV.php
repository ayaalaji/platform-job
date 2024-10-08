<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CV extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'file_path',
        'company_id'
    ];
     public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
