<?php

namespace LaraToolkit\Traits;

use Illuminate\Http\JsonResponse;
use Throwable;

trait ApiControllerTrait
{
    /**
     * Retorna uma resposta de sucesso.
     *
     * @param mixed       $data
     * @param string|null $message
     * @param int         $statusCode
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function returnSuccess($data, string $message = null, int $statusCode = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message ?? 'Operação realizada com sucesso.',
            'data'    => $data,
        ];

        return new JsonResponse($response, $statusCode);
    }

    /**
     * Retorna uma resposta de erro.
     *
     * @param string          $message
     * @param \Throwable|null $exception
     * @param int             $statusCode
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function returnError(string $message, Throwable $exception = null, int $statusCode = 500): JsonResponse
    {
        $response = [
            'success' => false,
        ];

        $response['message'] = $message;

        if ($exception instanceof \LaraToolkit\Exceptions\BusinessException) {
            $response['message'] = $exception->getMessage();
        }

        if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
            $response['message'] = "Você não tem permissão para realizar esta ação.";
            $statusCode = 403;
        }

        if ($exception) {
            $logger = \Illuminate\Container\Container::getInstance()->make(\Psr\Log\LoggerInterface::class);
            $logger->error($exception->getMessage(), [
                'exception' => $exception,
            ]);
        }

        $environment = \Illuminate\Container\Container::getInstance()->environment();

        if ($exception && $environment !== 'production') {
            $response['data'] = [
                'exception' => get_class($exception),
                'message'   => $exception->getMessage(),
                'file'      => $exception->getFile(),
                'line'      => $exception->getLine(),
                'trace'     => $exception->getTrace(),
            ];
        }

        return new JsonResponse($response, $statusCode);
    }
}
