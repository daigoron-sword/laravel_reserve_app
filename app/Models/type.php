<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class type extends Model
{
    // 割り当てをさせないようにする
    protected $guarded = ['id'];
}
