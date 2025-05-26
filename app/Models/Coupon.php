<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Coupon extends Model
{
    protected $fillable = ['receiver_id', 'code', 'is_taken', 'taken_at'];

    public function receiver()
    {
        return $this->belongsTo(Receiver::class);
    }
}
