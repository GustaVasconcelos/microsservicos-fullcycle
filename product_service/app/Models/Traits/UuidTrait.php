<?php
namespace App\Models\Traits;
use Ramsey\Uuid\Uuid;

trait UuidTrait {
    public static function boot() {
        parent::boot();

        static::creating(function($obj) {
            if(!$obj->id) {
                $obj->id = Uuid::uuid4();
            }
        });
    }
}