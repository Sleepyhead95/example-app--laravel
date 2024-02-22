<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    // we can use this to filter the data in our controller
    public function scopeFilter($query, array $filters)
    {

        if ($filters['tag'] ?? false) {
            return $query->where('tags', 'like', '%' . request('tag') . '%');
        }
    }
}
