<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Product extends Model implements TranslatableContract
{
    use HasFactory, Translatable;
    public $translatedAttributes = ['name', 'description'];
    protected $guarded = [];

    protected $appends = ['image_path'];  // 'profit_percent'

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_order');
    }

    // public function getProfitPercentAttribute()
    // {
    //     $profit = $this->sale_price - $this->profit_percent;
    //     $profit_percent = $profit * 100 / $this->purchase_price;

    //     return round($profit_percent, 2);
    // }

    public function getImagePathAttribute()
    {
        return $this->image ? asset('uploads/product_images/' . $this->image) : null;
    }
}
