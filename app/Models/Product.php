<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'price',
        'stock_quantity',
        'stock_alert_level',
        'image_path',
    ];

    // Ürün bir kategoriye aittir
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Ürün birçok satış kalemine sahiptir
    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    // Toplam satılan miktar


   
}
