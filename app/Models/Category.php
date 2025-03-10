<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_category';
    
    protected $fillable = [
        'name_category',
        'link',
        'id_parent',
    ];
    
    protected $hidden = [
        'hide',
    ];
    
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'id_category', 'id_category');
    }
    
    public function parent(): BelongsTo
    {
        return $this->belongsTo(CategoryParent::class, 'id_parent', 'id_parent');
    }
}