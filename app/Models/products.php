<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class products extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url'];

    public function priceHistories()
    {
        return $this->hasMany(price_histories::class, 'product_id');
    }
}
