<?php

namespace App\Service\Models;

use App\Repositories\Models\ProductRepository;

class ProductService extends BaseService
{
    protected $ProductRepository;

    public function __construct(ProductRepository $ProductRepository)
    {
        parent::__construct($ProductRepository);
    }
}
