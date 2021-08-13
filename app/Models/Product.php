<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    const PRODUCT_AVAILABLE = 1;
    const PRODUCT_UNAVAILABLE = 0;

    public function getSellingCostAttribute() {
        return "₹".ceil($this->selling_price);
    }
    public function getMrpCostAttribute() {
        return "₹".ceil($this->mrp);
    }
    public function getDiscountPercentageAttribute() {
        return $this->discount;
    }
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
    
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}

