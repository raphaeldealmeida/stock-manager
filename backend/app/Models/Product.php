<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'current_quantity',
    ];

    public function historics()
    {
        return $this->hasMany(Historic::class);
    }
}
