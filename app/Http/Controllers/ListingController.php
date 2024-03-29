<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

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
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
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

    // store new listing
    public function store(Request $request)
    {
        // form validation for each input field
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);


        // for uploading an image:
        // if the request/user input has a file, then we want to store it
        // in the public folder under the logos directory
        // in the DB, you only store the path to the file, not the file itself
        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        // this line is used to attach the user_id to the listing upon creating the listing
        $formFields['user_id'] = auth()->id();


        // we take our Listing Model and create a new instance of it
        // with the form fields input data that we validated
        Listing::create($formFields);

        // one way to create a flash message:
        // Session::flash('message', 'Listing created successfully!');

        // ->with() is a method that we can use to create a flash message too - it's a shortcut
        // but this just fires the message, you have to create it in a view to display it
        return redirect('/')->with('message', 'Listing created successfully!');
    }

    // show edit form
    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }

    // update edited form
    public function update(Request $request, Listing $listing)
    {
        // make sure logged in user is owner of listing
        if ($listing->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action');
        };
        // form validation for each input field
        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing updated successfully!');
    }

    // delete listing
    public function destroy(Listing $listing)
    {
        // make sure logged in user is owner of listing
        if ($listing->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action');
        };

        $listing->delete();

        return redirect('/')->with('message', 'Listing deleted successfully!');
    }

    // manage listings page
    public function manage()
    {
        // we not only return a view, we want to return the one with all the listings
        // of the user that is currectly logged in (auth()->user())
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
