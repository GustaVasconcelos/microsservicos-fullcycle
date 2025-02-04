<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponse
{
    /**
     * Retorna uma resposta de sucesso com links HATEOAS.
     *
     * @param  mixed  $data
     * @param  string  $message
     * @param  int  $statusCode
     * @param  array  $links
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($data = null, $message = 'Request bem-sucedido', $statusCode = Response::HTTP_OK, $links = [])
    {
        $response = [
            'status' => 'success',
            'message' => $message,
            'data' => $data,
            'links' => $links,
        ];

        return response()->json($response, $statusCode);
    }

    /**
     * Retorna uma resposta de erro com links HATEOAS.
     *
     * @param  string  $message
     * @param  int  $statusCode
     * @param  mixed  $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function error($message = 'Erro interno do servidor', $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR, $errors = null, $links = [])
    {
        $response = [
            'status' => 'error',
            'message' => $message,
            'errors' => $errors,
            'links' => $links,
        ];

        return response()->json($response, $statusCode);
    }

    /**
     * Retorna uma resposta de validação com links HATEOAS.
     *
     * @param  mixed  $errors
     * @param  string  $message
     * @param  int  $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function validationError($errors, $message = 'Erro de validação', $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY, $links = [])
    {
        $response = [
            'status' => 'error',
            'message' => $message,
            'errors' => $errors,
            'links' => $links,
        ];

        return response()->json($response, $statusCode);
    }
}
