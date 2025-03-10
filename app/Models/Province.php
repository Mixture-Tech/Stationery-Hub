<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_province';
    
    protected $fillable = [
        'name',
        'id_area',
    ];
    
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'id_area', 'id_area');
    }
    
    public function districts(): HasMany
    {
        return $this->hasMany(District::class, 'id_province', 'id_province');
    }
}