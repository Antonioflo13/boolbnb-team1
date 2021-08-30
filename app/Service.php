<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * Fillable
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Relations
     */
    public function appartments() {
        return $this->belongsToMany('App\Appartment');
    }
}
