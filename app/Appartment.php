<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appartment extends Model
{
    /**
     * Fillable
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'rooms_number',
        'bathrooms_number',
        'beds_number',
        'square_meters',
        'image',
        'visible'
    ];

    /**
     * Relations
     */
    public function user() {
        return $this->belongsTo('App\User');
    }
}
