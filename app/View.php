<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    /**
     * Fillable
     */
    protected $fillable = [
        'appartment_id'
    ];

    /**
     * Relations
     */
    public function appartment() {
        return $this->belongsTo('App\Appartment');
    }
}
