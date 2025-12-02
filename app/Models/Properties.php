<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    protected $table = 'properties';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    // PENTING: kolom yang bisa diisi (fillable)
    protected $fillable = [
        'UserID',
        'CategoryID',
        'Title',
        'Location',
        'Description',
        'Photos',
        'Price',
        'IsAvailable'
    ];

    public function propertycategory()
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
