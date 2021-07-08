<?php

namespace  App\Models;
use Illuminate\Database\Eloquent\Model;

class Quotes extends Model
{
    protected $with = ['students','user'];
    protected $table="quotes";// nombre de la tabla

    protected $fillable = [
        'student_id', 'user_id', 'date','affair'
    ];
    public function students()
    {
        return $this->belongsTo(Students::class,'student_id','id');
    }  
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }  
}
