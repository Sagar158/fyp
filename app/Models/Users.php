<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
class Users extends Model
{
    protected $table = 'users';
    protected $guarded = [];

    Use softDeletes;
    public function usertypes()
    {
        return $this->hasOne(Usertype::class,'id','usertype_id');
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
}
