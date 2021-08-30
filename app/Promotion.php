<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    /**
     * Fillable
     */
    protected $fillable = [
        'title',
        'price',
        'hours'
    ];

    /**
     * Relations
     */
    public function appartments() {
        return $this->belongsToMany('App\Appartment');
    }
}
