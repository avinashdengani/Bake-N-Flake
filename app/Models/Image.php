<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getImagePathAttribute()
    {
        return "storage/".$this->image;
    }
    public function deleteImage()
    {
        Storage::delete($this->image);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
