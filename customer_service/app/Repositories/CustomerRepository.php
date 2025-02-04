<?php

namespace App\Repositories;

use App\Interfaces\CustomerInterface;
use App\Repositories\BaseRepository;
use App\Models\Customer;

class CustomerRepository extends BaseRepository implements CustomerInterface
{
    public function __construct(Customer $model)
    {
        parent::__construct($model);
    }
}