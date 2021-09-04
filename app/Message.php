<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * Fillable
     */
    protected $fillable = [
        'appartment_id',
        'name',
        'email',
        'message'
    ];

    /**
     * Relations
     */
    public function appartment() {
        return $this->belongsTo('App\Appartment');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
