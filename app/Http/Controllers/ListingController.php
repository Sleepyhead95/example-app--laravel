<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

// we use controllers to write the login of the routing 
// then we can pass the controller to the route, instead of
// writing the logic in the route file

// command: php artisan make:controller ListingController
class ListingController extends Controller
{
    // get and show all listings
    public function index()
    {

        return view('listings', [
            'listings' => Listing::all()
        ]);
    }

    //show single listing
    public function show(Listing $listing)
    {
        return view('listing', [
            'listing' => $listing
        ]);
    }
}
