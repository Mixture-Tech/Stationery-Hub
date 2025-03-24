<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryParent extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_parent';
    
    protected $fillable = [
        'name_parent',
        'link',
        'hide',
    ];
    
    protected $hidden = [
        'hide',
    ];
    
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'id_parent', 'id_parent');
    }

    public function products()
    {
        return $this->hasManyThrough(
            Product::class,
            Category::class,
            'id_parent',
            'id_category',
            'id_parent',
            'id_category'
        );
    }
}