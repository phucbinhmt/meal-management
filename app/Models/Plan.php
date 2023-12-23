<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'plans'; 
    protected $primaryKey = 'plan_id';
    protected $fillable = [
        'date',
        'session',
        'status',
        'user_id',
    ];
    public $timestamp = false;
    protected $attributes = [
        'status' => 2,
    ];

    public function dishes(): BelongsToMany
    {
        return $this->belongsToMany(Dish::class, 'plan_details', 'plan_id', 'dish_id')->withPivot('quantity');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
