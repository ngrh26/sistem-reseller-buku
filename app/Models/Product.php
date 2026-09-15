<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'price',
        'stock',
        'description',
        'cover_image',
        'category',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getCoverUrlAttribute(): string
    {
        return $this->cover_image
            ? asset('storage/' . $this->cover_image)
            : asset('images/book-placeholder.png');
    }
}