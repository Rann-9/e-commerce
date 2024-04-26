<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product_galleries()
    {
        return $this->hasMany(ProductGallery::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function transaction_item()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
