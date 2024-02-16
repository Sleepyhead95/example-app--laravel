<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

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
Route::get('/', function () {
    return view('listings', [
        'heading' => 'Latest Listings',
        'listings' => [
            'title' => 'Job Listing 1',
            'description' => 'This is a description of job 1'
        ],
        [
            'title' => 'Job Listing 1',
            'description' => 'This is a description of job 1'
        ]

    ]);
});

// different ways to create a route:
// Route::get('/hello', function () {
//     return response('<h1>Hello World</h1>', 200)
//         ->header('Content-Type', 'text/html')
//         ->header('foo', 'bar');
// });

// Route::get('/search', function(Request $request) {
//     return $request->name . "" . $request->city;
// });