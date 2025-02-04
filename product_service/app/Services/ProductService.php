<?php

namespace App\Services;

use App\Interfaces\ProductInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAll(): Collection
    {
        return $this->productRepository->all();
    }

    public function create(array $data): Model
    {
        return $this->productRepository->create($data);
    }

    public function show(string $id): ?Model 
    {
        return $this->productRepository->show($id);
    }

    public function update(string $id, array $data): bool
    {
        return $this->productRepository->update($id, $data);
    }

    public function delete(string $id): bool
    {
        return $this->productRepository->delete($id);
    }
}
