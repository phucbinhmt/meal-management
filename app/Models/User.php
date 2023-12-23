<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users'; 
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id',
        'last_name',
        'first_name',
        'gender',
        'birth_date',
        'phone',
        'email',
        'status',
        'salary',
        'image',
        'password',
        'address_id',
        'position_id',
    ];
    public $timestamp = false;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $attributes = [
        'status' => 1,
    ];

    protected $appends = ['full_name'];

    public function getFullNameAttribute()
    {
        return $this->attributes['last_name'] . ' ' . $this->attributes['first_name'];
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'address_id', 'address_id');
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'position_id', 'position_id');
    }

    public function plans(): HasMany
    {
        return $this->hasMany(Plan::class, 'user_id', 'user_id');
    }
    
    protected static function booted()
    {
        static::deleting(function ($user) {
            if ($user->image) {
                unlink(public_path('images/users/') . $user->image);
            }
        });
    }
}
