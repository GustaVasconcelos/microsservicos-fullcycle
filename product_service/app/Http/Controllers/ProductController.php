<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Exception;
use App\Models\Product;

class ProductController extends Controller
{
    use ApiResponse;

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(): JsonResponse
    {
        try {
            $products = $this->productService->getAll();
            $links = [
                'self' => route('products.index'),
                'create' => route('products.create'),
            ];
            
            $products = $products->map(function ($product) {
                $product->links = [
                    'update' => route('products.update', $product->id),
                    'delete' => route('products.destroy', $product->id),
                ];
                return $product;
            });

            return $this->success($products, 'Produtos recuperados com sucesso', 200, $links);
        } catch (Exception $e) {
            return $this->error('Erro ao recuperar produtos', 500, $e->getMessage());
        }
    }

    public function store(CreateProductRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $product = $this->productService->create($data);
            $links = [
                'self' => route('products.show', $product->id),
                'update' => route('products.update', $product->id),
                'delete' => route('products.destroy', $product->id),
            ];
            return $this->success($product, 'Produto criado com sucesso', 201, $links);
        } catch (Exception $e) {
            return $this->error('Erro ao criar produto', 500, $e->getMessage());
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $product = $this->productService->show($id);
            if (!$product) {
                return $this->error('Produto não encontrado', 404);
            }
            $links = [
                'self' => route('products.show', $id),
                'update' => route('products.update', $id),
                'delete' => route('products.destroy', $id),
            ];
            return $this->success($product, 'Produto recuperado com sucesso', 200, $links);
        } catch (Exception $e) {
            return $this->error('Erro ao recuperar produto', 500, $e->getMessage());
        }
    }

    public function update(UpdateProductRequest $request, string $id): JsonResponse
    {
        try {
            $data = $request->validated();
            $product = $this->productService->update($id, $data);
            if (!$product) {
                return $this->error('Produto não encontrado ou não foi possível atualizar', 400);
            }
            $links = [
                'self' => route('products.show', $id),
                'delete' => route('products.destroy', $id),
            ];
            return $this->success($product, 'Produto atualizado com sucesso', 200, $links);
        } catch (Exception $e) {
            return $this->error('Erro ao atualizar produto', 500, $e->getMessage());
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $deleted = $this->productService->delete($id);
            if (!$deleted) {
                return $this->error('Produto não encontrado ou não foi possível deletar', 400);
            }
            $links = [
                'self' => route('products.index'),
                'create' => route('products.create'),
            ];
            return $this->success(null, 'Produto deletado com sucesso', 204, $links);
        } catch (Exception $e) {
            return $this->error('Erro ao deletar produto', 500, $e->getMessage());
        }
    }
}
