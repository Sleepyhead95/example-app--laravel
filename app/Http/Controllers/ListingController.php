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
        // to get the current tag (that was clicked by the user and is 
        // stored in the query string of the URL)
        // dd(request('tag'));


        // since we renamed the view from listings to index
        // we need to reference it correctly
        // here, index file in the listings folder
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get()
            // we can also use ::all() but latest orders our data chronologically
            // we can add the filter function from out Model to filter through the array of tags
            // that are saved in our database
            // the get method will fetch those resutls for us
        ]);
    }

    //show single listing
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // show create form
    public function create()
    {
        return view('listings.create');
    }
}
