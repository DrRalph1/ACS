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

// The REST API that allows the young woman to send her desired net salary and allowances 
Route::post('/sendNetSalaryANDAllowances', 'JobOfferDetailsController@store');

// The REST API that returns the corresponding gross salary and additional details (Basic Salary, allowances, Total PAYE Tax, Employee Pension Contribution Amount and Employer Pension amount)
Route::get('/getGrossSalaryANDAdditionalDetails', 'JobOfferDetailsController@index');
