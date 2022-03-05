<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    protected function successJsonResponse(string $id, array $result): JsonResponse
    {
        return $this->jsonResponse($id, $result);
    }

    protected function errorJsonResponse(string $id, int $code, string $message): JsonResponse
    {
        return $this->jsonResponse($id, null, compact('code', 'message'));
    }

    private function jsonResponse(string $id, array $result = null, array $error = null): JsonResponse
    {
        $data = [
            'jsonrpc' => '2.0',
            'id' => $id,
        ];

        if (!is_null($result)) {
            $data['result'] = $result;
        }

        if (!is_null($error)) {
            $data['error'] = $error;
        }

        return response()->json($data);
    }
}
