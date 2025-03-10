<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class District extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_district';
    
    protected $fillable = [
        'name',
        'id_province',
        'fee',
    ];
    
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'id_province', 'id_province');
    }
    
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'id_district', 'id_district');
    }
}