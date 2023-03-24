<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('create_new_lead', [\App\Http\Controllers\UserController::class, "new_lead"]);
Route::get('admin_get_leads', [\App\Http\Controllers\AdminController::class, "admin_leads_list"]);
Route::get('get_leads/{id}/{usertype}', [\App\Http\Controllers\UserController::class, "leads_list"]);
Route::post('add_product', [\App\Http\Controllers\AdminController::class, "add_products"]);
Route::get('list_of_products', [\App\Http\Controllers\AdminController::class, "products_list"]);
Route::get('lead_details/{id}', [\App\Http\Controllers\UserController::class, "lead_details"]);
Route::post('add_customer', [\App\Http\Controllers\UserController::class, "new_customer"]);
Route::get('product_details/{id}', [\App\Http\Controllers\AdminController::class, "product_details"]);
Route::post('save-customer-product', [\App\Http\Controllers\UserController::class, "customer_products"]);
Route::get('get_customer_product/{id}', [\App\Http\Controllers\UserController::class, "customer_products_list"]);
Route::post('create_new_user', [\App\Http\Controllers\AdminController::class, "new_user"]);
Route::get('users_list', [\App\Http\Controllers\AdminController::class, "get_users_list"]);
Route::post('login', [\App\Http\Controllers\AuthenticationController::class, 'login']);
