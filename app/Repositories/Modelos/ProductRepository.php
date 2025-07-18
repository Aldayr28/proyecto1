<?php

namespace App\Repositories\Models;

use App\Models\Producto;

class ProductRepository extends BaseRepository
{
    const RELATIONS = ['prices', 'brands', 'measureUnit'];

    public function __construct(Producto $product)
    {
        parent::__construct($product, self::RELATIONS);
    }
}