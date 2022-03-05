<?php

namespace App\Http\Controllers;

use App\Services\Activity\ActivityService;

class AdminController extends Controller
{
    public function activity(ActivityService $activityService)
    {
        return view('activities', $activityService->route()->getActivity());
    }
}
