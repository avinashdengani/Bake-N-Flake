<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //RELATIONSHIPS

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
