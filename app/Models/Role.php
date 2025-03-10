<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

// Model Role
class Role extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_role';
    
    protected $fillable = [
        'name',
    ];
    
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'id_role', 'id_role');
    }
}