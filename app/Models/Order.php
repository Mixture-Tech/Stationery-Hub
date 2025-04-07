<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_order';
    
    protected $fillable = [
        'total_price',
        'status',
        'id_district',
        'id_province',
        'id_area',
        'id_user',
        'payment_methods',
        'hide',
        'updated_at',
        'momo_order_id',
        'vnpay_order_id',
        'phone',
        'address'
    ];
    
    protected $hidden = [
        'hide',
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
    
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'id_district', 'id_district');
    }
    
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'id_province', 'id_province');
    }
    
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'id_area', 'id_area');
    }
    
    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'id_order', 'id_order');
    }
}