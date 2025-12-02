<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    protected $table = 'properties';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

<<<<<<< HEAD
    protected $fillable = [
        'user_id',
        'title',
        'location',
        'category',
        'description',
        'photos',
        'picture',
        'isAvailable'
    ];


     public function propertycategory()
=======
    public function propertycategory()
>>>>>>> cal
    {
        return $this->belongsTo(PropertyCategories::class, 'CategoryID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function favorite()
    {
        return $this->belongsToMany(User::class, 'favorites', 'PropertyID', 'UserID');
    }
}
