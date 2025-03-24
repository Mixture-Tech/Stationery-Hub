<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_product';
    
    protected $fillable = [
        'id_category',
        'name',
        'nums',
        'price',
        'detail',
        'link',
        'discount_price',
        'description',
        'image',
        'discount',
        'brand',
        'hide',
    ];
    
    protected $hidden = [
        'hide',
    ];
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }
    
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'id_product', 'id_product');
    }
    
    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'id_product', 'id_product');
    }
}