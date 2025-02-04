<?php

namespace App\Services;

use App\Interfaces\CustomerInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CustomerService
{
    protected $customerRepository;

    public function __construct(CustomerInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function getAll(): Collection
    {
        return $this->customerRepository->all();
    }

    public function create(array $data): Model
    {
        return $this->customerRepository->create($data);
    }

    public function show(string $id): ?Model 
    {
        return $this->customerRepository->show($id);
    }

    public function update(string $id, array $data): bool
    {
        return $this->customerRepository->update($id, $data);
    }

    public function delete(string $id): bool
    {
        return $this->customerRepository->delete($id);
    }
}
