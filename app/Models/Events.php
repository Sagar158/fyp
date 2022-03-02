<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use App\Models\Promotions;
class Events extends Model
{
    Use softDeletes;
    protected $table = 'events';
    protected $guarded = [];

    public function promotion()
    {
        return $this->hasOne(Promotions::class, 'id','promo_id');
    }
}
