<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus'; 
    protected $primaryKey = 'menu_id';
    protected $fillable = [
        'date',
    ];
    public $timestamp = false;

    public function dishes(): BelongsToMany
    {
        return $this->belongsToMany(Dish::class, 'menu_details', 'menu_id', 'dish_id');
    }
}
