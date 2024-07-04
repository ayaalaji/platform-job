<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory,SoftDeletes;

    protected $dates = ['deleted_at'];
   


    protected $fillable=[
        'name',
        'email',
        'password',
        'address',
        'descraption',
        'manager',
        'manager_phone',
    ];
    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function articles(){
        return $this->hasMany(Article::class);
    }
}
