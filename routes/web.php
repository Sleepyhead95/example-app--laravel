<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// we can physically add data to the view by adding a second argument to the view function

// All Listings:
Route::get('/', [ListingController::class, 'index']);

// Single Listing:
// Route::get('/listings/{id}', function ($id) {

//     return view('listing', [
//         'listing' => Listing::find($id)
//     ]);
// });

// Single listing with route model binding:
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// controllers: 
