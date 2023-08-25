<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'country', 'latitude', 'longitude', 'population', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
