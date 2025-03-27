<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentTutors extends Model
{
    //

    protected $fillable = [];

    public function student() : BelongsTo 
    {
        return $this->belongsTo(Student::class, 'student', 'id');    
    }

    public function tutor() : BelongsTo 
    {
        return $this->belongsTo(Tutor::class, 'tutor', 'id');    
    }
}
