<?php

namespace LaraToolkit\Traits;

use Illuminate\Http\JsonResponse;

trait ApiControllerTrait
{
    protected function returnSuccess(mixed $data = [], string $customMessage = null, int $statusCode = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'data' => $data,
        ];

        if (!is_null($customMessage)) {
            $response['message'] = $customMessage;
        }

        return new JsonResponse($response, $statusCode);
    }

    protected function returnException(string $customMessage, \Throwable $exception, int $statusCode = 400): JsonResponse
    {
        $errorData = [
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTrace(),
        ];

        //TODO: Imeplment env verification for show error details

        $response = [
            'success' => true,
            'message' => $customMessage,
            'error' => $errorData,
        ];

        return new JsonResponse($response, $statusCode);
    }
}