<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const USER_ADMIN = 1;
    const USER_CUSTOMER = 0;

    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'mobile_no'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //HELPERS
    public function isAdmin()
    {
        return $this->role === self::USER_ADMIN;
    }

    //GETTERS
    public function getImagePathAttribute()
    {
        return "https://ui-avatars.com/api/?name={$this->name}&rounded=true&size=120&background=random";
    }

    //RELATIONSHIPS
    public function testimonial()
    {
        return $this->hasOne(Testimonial::class);
    }
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
