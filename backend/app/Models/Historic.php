<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historic extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'product_id', 'quantity', 'quantity_at',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
