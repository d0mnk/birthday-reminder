<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['firstname', 'lastname', 'birthday'];

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function getBirthdayFormatted($format = "m/d/Y"){
        return \Carbon\Carbon::parse($this->birthday)->format($format);
    }
}
