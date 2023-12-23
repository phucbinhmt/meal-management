<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DishType extends Model
{
    use HasFactory;

    protected $table = 'dish_types'; 
    protected $primaryKey = 'dish_type_id';
    protected $fillable = [
        'dish_type_name',
    ];

    public $timestamp = false;

    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class, 'dish_type_id', 'dish_type_id');
    }
}
