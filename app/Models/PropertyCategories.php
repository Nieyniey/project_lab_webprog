<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyCategories extends Model
{
    protected $table = 'propertycategories';

    public function properties()
    {
        return $this->hasMany(Properties::class, 'CategoryID');
    }
}
