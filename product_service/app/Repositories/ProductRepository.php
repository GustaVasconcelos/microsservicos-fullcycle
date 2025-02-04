<?php

namespace App\Repositories;

use App\Interfaces\ProductInterface;
use App\Repositories\BaseRepository;
use App\Models\Product;

class ProductRepository extends BaseRepository implements ProductInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }
}