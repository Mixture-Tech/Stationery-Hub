<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id_product',
        'quantity',
        'total_price',
        'id_user',
        'purchased_at',
    ];
    
    protected $hidden = [
        'hide',
    ];

    protected $casts = [
        'purchased_at' => 'datetime',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
    
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }
}