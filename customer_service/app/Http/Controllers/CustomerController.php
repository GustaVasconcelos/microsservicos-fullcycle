<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Exception;

class CustomerController extends Controller
{
    use ApiResponse;

    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index(): JsonResponse
    {
        try {
            $customers = $this->customerService->getAll();
            $links = [
                'self' => route('customers.index'),
                'create' => route('customers.create'),
            ];
            
            $customers = $customers->map(function ($customer) {
                $customer->links = [
                    'update' => route('customers.update', $customer->id),
                    'delete' => route('customers.destroy', $customer->id),
                ];
                return $customer;
            });

            return $this->success($customers, 'Clientes recuperados com sucesso', 200, $links);
        } catch (Exception $e) {
            return $this->error('Erro ao recuperar Clientes', 500, $e->getMessage());
        }
    }

    public function store(CreatecustomerRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $customer = $this->customerService->create($data);
            $links = [
                'self' => route('customers.show', $customer->id),
                'update' => route('customers.update', $customer->id),
                'delete' => route('customers.destroy', $customer->id),
            ];
            return $this->success($customer, 'Cliente criado com sucesso', 201, $links);
        } catch (Exception $e) {
            return $this->error('Erro ao criar Cliente', 500, $e->getMessage());
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $customer = $this->customerService->show($id);
            if (!$customer) {
                return $this->error('Cliente não encontrado', 404);
            }
            $links = [
                'self' => route('customers.show', $id),
                'update' => route('customers.update', $id),
                'delete' => route('customers.destroy', $id),
            ];
            return $this->success($customer, 'Cliente recuperado com sucesso', 200, $links);
        } catch (Exception $e) {
            return $this->error('Erro ao recuperar Cliente', 500, $e->getMessage());
        }
    }

    public function update(UpdateCustomerRequest $request, string $id): JsonResponse
    {
        try {
            $data = $request->validated();
            $customer = $this->customerService->update($id, $data);
            if (!$customer) {
                return $this->error('Cliente não encontrado ou não foi possível atualizar', 400);
            }
            $links = [
                'self' => route('customers.show', $id),
                'delete' => route('customers.destroy', $id),
            ];
            return $this->success($customer, 'Cliente atualizado com sucesso', 200, $links);
        } catch (Exception $e) {
            return $this->error('Erro ao atualizar Cliente', 500, $e->getMessage());
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $deleted = $this->customerService->delete($id);
            if (!$deleted) {
                return $this->error('Cliente não encontrado ou não foi possível deletar', 400);
            }
            $links = [
                'self' => route('customers.index'),
                'create' => route('customers.create'),
            ];
            return $this->success(null, 'Cliente deletado com sucesso', 204, $links);
        } catch (Exception $e) {
            return $this->error('Erro ao deletar Cliente', 500, $e->getMessage());
        }
    }
}
