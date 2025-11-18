<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    protected $table = 'properties';

     public function propertycategory()
    {
        return $this->belongsTo(PropertyCategories::class, 'CategoryID');
    }

    public function user()
    {
        return $this->belongsTo(Users::class, 'UserID');
    }

    public function favorit()
    {
        return $this->belongsToMany(Users::class, 'favorites', 'PropertyID', 'UserID');
    }
}
