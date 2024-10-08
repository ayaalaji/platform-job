<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
        'title',
        'body',
        'company_id',
        'photo'
    ];
    public function company(){
        return $this->belongsTo(Company::class);
    }
}
