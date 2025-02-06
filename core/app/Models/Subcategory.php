<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use GlobalStatus, Searchable;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
