<?php

namespace App\Models;

class Listing
{
    public static function all()
    {
        return [
            [
                'title' => 'Job Listing 1',
                'description' => 'This is a description of job 1'
            ],
            [
                'title' => 'Job Listing 2',
                'description' => 'This is a description of job 2'
            ]
        ];
    }

    public static function find($id)
    {
        $listings = self::all();
        foreach ($listings as $listing) {
            if ($id == $listing['id']) {
                return $listing;
            }
        }
    }
}
