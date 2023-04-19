<?php

namespace App\Models\Api;

class Product extends \App\Models\Product
{
    public function getRouteKeyName()
    {
        return 'id';
    }

    // TODO: allow multiple images for a product
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
