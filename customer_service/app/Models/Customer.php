<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use UuidTrait;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'zipcode',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}