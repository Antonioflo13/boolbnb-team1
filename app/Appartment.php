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
        'slug',
        'description',
        'rooms_number',
        'bathrooms_number',
        'beds_number',
        'square_meters',
        'image',
        'visible',
        'longitude',
        'latitude',
        'address'
    ];

    /**
     * Relations
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function messages() {
        return $this->hasMany('App\Message');
    }

    public function views() {
        return $this->hasMany('App\View');
    }

    public function services() {
        return $this->belongsToMany('App\Service');
    }

    public function promotions() {
        return $this->belongsToMany('App\Promotion')->withPivot(['start_promotion','end_promotion']);
    }
}
