<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    //GUARDED PROPERTY
    protected $guarded = ['id'];

    //CONSTANTS
    const PRODUCT_AVAILABLE = 1;
    const PRODUCT_UNAVAILABLE = 0;

    //GETTERS
    public function getSellingCostAttribute() {
        return "₹".$this->selling_price;
    }
    public function getSellingPriceAttribute(){
        return $this->mrp - ($this->mrp * $this->discount)/100;
    }
    public function getMrpCostAttribute() {
        return "₹" .$this->mrp;
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
    public function getGetStatusAttribute()
    {
        if($this->status === self::PRODUCT_AVAILABLE) {
            return "Available";
        } else {
            return "Unavailable";
        };
    }
    public function getStatusCssAttribute()
    {
        if($this->status === self::PRODUCT_AVAILABLE) {
            return "text-success";
        } else {
            return "text-danger";
        };
    }

    //HELPER METHODS
    public function hasCity(int $city_id):bool
    {
        return in_array($city_id, $this->cities->pluck('id')->toArray());
    }

    //SCOPES
    public function scopeSearch($query)
    {
        $search = request('search');
        if($search) {
            return $query->where("name", "like", "%$search%");
        }
        return $query;
    }

    public function scopeProductsAvailable($query)    {
        return $query->where('status', self::PRODUCT_AVAILABLE);
    }

    public function scopeProductsUnavailable($query)
    {
        return $query->where('status', self::PRODUCT_UNAVAILABLE);
    }

    //RELATIONSHIPS
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function cities()
    {
        return $this->belongsToMany(City::class)->withTimestamps();
    }
}

