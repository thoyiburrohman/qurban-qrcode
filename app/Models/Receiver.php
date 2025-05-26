<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Receiver extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = ['user_id', 'name', 'nik',  'password'];

    protected $hidden = ['password'];

    public function coupon()
    {
        return $this->hasOne(Coupon::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
