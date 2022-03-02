<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class EndUsers extends Model
{
    Use softDeletes;
    protected $table = 'endusers';
    protected $guarded = [];
}
