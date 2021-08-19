<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getEditedDateAttribute()
    {
        if($this->updated_at == $this->created_at ) {
            return null;
        }
        return $this->updated_at->diffForHumans();;
    }
    public function getImagePathAttribute()
    {
        return 'storage/' .$this->image;
    }
    public function deleteImage()
    {
        Storage::delete($this->image);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
