<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
