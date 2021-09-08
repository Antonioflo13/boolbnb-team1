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
        'user_id',
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
}
