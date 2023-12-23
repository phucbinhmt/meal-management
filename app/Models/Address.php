<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses'; 
    protected $primaryKey = 'address_id';
    protected $fillable = [
        'province_name',
    ];

    public $timestamp = false;

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'address_id', 'address_id');
    }
}
