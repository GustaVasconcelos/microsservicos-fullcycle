<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Interfaces\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface 
{
    protected $model; 

    public function __construct(Model $model) 
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(string $id, array $data): bool
    {
        $model = $this->model->find($id);
        if (!$model) {
            return false; 
        }
        return $model->update($data);
    }

    public function delete(string $id): bool 
    {
        $model = $this->model->find($id);
        if (!$model) {
            return false;
        }

        return $model->delete();
    }

    public function show(string $id): ?Model
    {
        return $this->model->find($id);
    }
}
