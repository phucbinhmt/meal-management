<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Dish extends Model
{
    use HasFactory;

    protected $table = 'dishes'; 
    protected $primaryKey = 'dish_id';
    protected $fillable = [
        'dish_name',
        'description',
        'image',
        'price',
        'status',
        'dish_type_id',
    ];
    public $timestamp = false;
    protected $attributes = [
        'status' => 1,
    ];

    public function dish_type(): BelongsTo
    {
        return $this->belongsTo(DishType::class, 'dish_type_id', 'dish_type_id');
    }

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class, 'menu_details', 'dish_id', 'menu_id');
    }

    public function plans(): BelongsToMany
    {
        return $this->belongsToMany(Plan::class, 'plan_details', 'dish_id', 'plan_id')->withPivot('quantity');
    }

    protected static function booted()
    {
        static::deleting(function ($dish) {
            if ($dish->image) {
                unlink(public_path('images/dishes/') . $dish->image);
            }
        });
    }

}
