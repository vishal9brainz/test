<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    protected $fillable=['user_id','rides_DateTime','from_place','to_place','seats','routes'];
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
