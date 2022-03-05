<?php

namespace App\Http\Controllers;

use App\Http\Requests\JsonRpcRequest;
use App\Services\ActivityService;
use Illuminate\Http\JsonResponse;

class JsonRpcController extends Controller
{
    private ActivityService $activityService;

    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;
    }

    public function __invoke(JsonRpcRequest $request): JsonResponse
    {
        return match ($request->dataMethod()) {
            'getActivities' => $this->executeGetActivities($request->dataId()),
            'storeActivity' => $this->executeStoreActivity($request->dataId(), $request->dataParams()),
            default => $this->notFound($request->dataId()),
        };
    }

    protected function executeGetActivities(string $id): JsonResponse
    {
        $result = $this->activityService->getUrlsCounters();

        return $this->successJsonResponse($id, [
            'items' => $result->items(),
            'next' => $result->nextPageUrl(),
            'prev' => $result->previousPageUrl(),
        ]);
    }

    protected function executeStoreActivity(string $id, array $params): JsonResponse
    {
        $this->activityService->incrementUrlCounter($params['url']);

        return $this->successJsonResponse($id, [
            'message' => 'success',
        ]);
    }

    protected function notFound(string $id): JsonResponse
    {
        return $this->errorJsonResponse($id, 404, 'Method not found');
    }
}
