<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends Model
{
    use HasFactory;

    protected $table = 'positions'; 
    protected $primaryKey = 'position_id';
    protected $fillable = [
        'position_name',
        'permission',
    ];

    public $timestamp = false;

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'position_id', 'position_id');
    }

}
