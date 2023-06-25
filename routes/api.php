<?php

use App\Http\Controllers\API\AddAttributes;
use App\Http\Controllers\API\CreateEntity;
use App\Http\Controllers\API\CreateInstance;
use App\Http\Controllers\API\CreateRelationship;
use App\Http\Controllers\API\ViewEntity;
use App\Http\Controllers\API\ViewInstance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/entities/{entity:ulid}', ViewEntity::class)
        ->name('entities.view');

    Route::post('/entities', CreateEntity::class)
        ->name('entities.create');

    Route::post('/entities/{entity:ulid}/attributes', AddAttributes::class)
        ->name('entities.attributes.create');

    Route::get('/instances/{instance:ulid}', ViewInstance::class)
        ->name('instances.view');

    Route::post('/instances', CreateInstance::class)
        ->name('instances.create');

    Route::post('/relationships', CreateRelationship::class)
        ->name('relationships.create');
});
