<?php

use App\Http\Controllers\JsonRpcController;
use Illuminate\Support\Facades\Route;

Route::post('jsonrpc', JsonRpcController::class);
