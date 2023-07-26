<?php

use Illuminate\Support\Facades\Route;
use Slowlyo\OwlOperationLog\Http\Controllers;

Route::resource('admin_operation_log', Controllers\OwlOperationLogController::class)->only([
    'index',
    'show',
    'destroy',
]);
