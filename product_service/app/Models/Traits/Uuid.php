<?php
namespace App\Models\Traits;
use Ramsey\Uuid\Uuid;

trait Uuid {
    public static function boot() {
        parent::boot();

        static::creting(function($obj) {
            if(!$obj->id) {
                $obj->id = Uuid::uuid4();
            }
        })
    }
}