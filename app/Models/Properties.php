<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    protected $table = 'properties';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    public function propertycategory()
    {
        return $this->belongsTo(PropertyCategories::class, 'CategoryID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function favorit()
    {
        return $this->belongsToMany(User::class, 'favorites', 'PropertyID', 'UserID');
    }
}
