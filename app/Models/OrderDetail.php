<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_order_detail';
    
    protected $fillable = [
        'id_product',
        'id_order',
        'id_district',
        'id_province',
        'id_area',
        'quantity',
        'total_product',
    ];
    
    protected $hidden = [
        'hide',
    ];
    
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'id_order', 'id_order');
    }
    
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }
}