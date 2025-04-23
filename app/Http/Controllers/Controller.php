<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class Controller extends BaseController
{
    /**
     * @param mixed $data
     *
     * @return JsonResponse
     */
    protected function respondCreated(mixed $data): JsonResponse
    {
        return response()->json(
            [
                'code' => ResponseAlias::HTTP_CREATED,
                'status' => 'ok',
                'data' => $data,
            ],
            ResponseAlias::HTTP_CREATED
        );
    }

    /**
     * @param mixed $data
     * @param array $headers
     *
     * @return JsonResponse
     */
    protected function respondSuccess(mixed $data, array $headers = []): JsonResponse
    {
        return response()->json(
            [
                'code' => ResponseAlias::HTTP_OK,
                'status' => 'ok',
                'data' => $data,
            ],
            ResponseAlias::HTTP_OK,
            $headers
        );
    }

    /**
     * @param mixed $errors
     * @param int|string $errorCode
     *
     * @return JsonResponse
     */
    protected function respondError(array $errors, int|string $errorCode): JsonResponse
    {
        return response()->json(
            [
                'code' => $errorCode,
                'status' => 'error',
                'errors' => $errors,
            ],
            $errorCode
        );
    }

    /**
     * @param mixed $data
     *
     * @return JsonResponse
     */
    protected function respondNotFound(mixed $data): JsonResponse
    {
        return response()->json(
            [
                'code' => '404',
                'status' => 'error',
                'data' => $data,
            ],
            ResponseAlias::HTTP_NOT_FOUND
        );
    }

    /**
     * @param mixed $errors
     *
     * @return JsonResponse
     */
    public function respondNotAllowed(mixed $errors): JsonResponse
    {
        return response()->json(
            [
                'code' => 403,
                'status' => 'error',
                'errors' => $errors,
            ],
            403
        );
    }
}
