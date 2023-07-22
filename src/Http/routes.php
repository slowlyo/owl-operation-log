<?php

use Slowlyo\OwlOperationLog\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('admin_operation_log', [Controllers\OwlOperationLogController::class, 'index']);
