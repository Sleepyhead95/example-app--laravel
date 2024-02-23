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



// Common Resource Routes (naming conventions):
// index - show all data
// show - show single data 
// create - show form to create new data
// store - store/save new data
// edit - show form to edit data
// update - update data
// destroy - delete data

// can use these names in blade views instead of a random name
// depending on their functionality
// so our listings view that shows all listings will be called 'index

// show create form:
Route::get('/listings/create', [ListingController::class, 'create']);

// store new listing:
Route::post('/listings', [ListingController::class, 'store']);

//only temporary for debuggin flash message
Route::get('/test-session', function () {
    dd(session()->all());
});

// Single listing with route model binding:
Route::get('/listings/{listing}', [ListingController::class, 'show']);
