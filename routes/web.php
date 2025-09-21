<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TestMailController;
use App\Http\Controllers\TestReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('test-mail')->group(function () {
    Route::get('/blade', [TestMailController::class, 'blade']);
    Route::get('/markdown', [TestMailController::class, 'markdown']);
    Route::get('/simple', [TestMailController::class, 'simple']);
    Route::get('/with-attachment', [TestMailController::class, 'withAttachment']);
    Route::get('/with-pdf', [TestMailController::class, 'withPdf']);
});

Route::prefix('test-pdf')->group(function () {
    Route::get('/generate', [TestReportController::class, 'generatePdf']);
});
