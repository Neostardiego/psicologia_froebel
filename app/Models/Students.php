<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Students extends Authenticatable
{
    use Notifiable;
    //protected $with = ['citas'];
    protected $table="students";
    protected $fillable = [
        'name', 'surnames', 'age','phone','grade'
    ];
    protected $hidden = [
        'created_at', "updated_at"
    ];
    public function citas()
    {
       return $this->hasMany('App\Models\Quotes', 'student_id');
    }
   
}
