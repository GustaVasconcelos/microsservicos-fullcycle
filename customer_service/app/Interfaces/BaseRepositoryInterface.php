<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface BaseRepositoryInterface {
    public function all(): Collection;

    public function create(array $data): Model;

    public function update(string $id, array $data): bool;

    public function delete(string $id): bool;

    public function show(string $id): ?Model;
}