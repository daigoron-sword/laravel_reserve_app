<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // リレーションの定義
    public function reservations()
    {
        return $this->hasmany('App\Models/Reservation');
    }
}
