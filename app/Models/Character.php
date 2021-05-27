<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'url',
        'gender',
        'culture',
        'born',
        'died',
    ];

    public function titles()
    {
        return $this->belongsToMany(Title::class);
    }
}
