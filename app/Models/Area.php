<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_area';
    
    protected $fillable = [
        'name',
    ];
    
    public function provinces(): HasMany
    {
        return $this->hasMany(Province::class, 'id_area', 'id_area');
    }
}