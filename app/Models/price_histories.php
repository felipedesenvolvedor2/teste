<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class price_histories extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'price', 'scraped_at'];

    protected $casts = [
        'scraped_at' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(products::class);
    }
}
