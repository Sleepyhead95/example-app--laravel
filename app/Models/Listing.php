<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    // fillable property is used to specify which fields are allowed to be mass assigned
    // in order to be input into the database - this is a security feature  
    protected $fillable = [
        'title',
        'company',
        'location',
        'website',
        'email',
        'tags',
        'description',
        'logo'
    ];

    // we can use this to filter the data in our controller
    public function scopeFilter($query, array $filters)
    {
        // if tag is not false, then we want to filter and return the query
        // that corresponds to the tag
        if ($filters['tag'] ?? false) {
            return $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        // this is for the search bar - the form input name is 'search', so that's why we're 
        // using request('search')
        if ($filters['search'] ?? false) {
            return $query->where('title', 'like', '%' . request('search') . '%')
                // orWhere is used to chain the where clauses together so you can looks through more columns
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }
}
