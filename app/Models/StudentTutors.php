<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentTutors extends Model
{
    protected $fillable = [
        'studentID', # from students table
        'tutorID', # from tutors table
        'studentSubscribedPackages', # from students subscribed packages
        'subjects', # json : subjectName, noOfLessons, grade, comments, remarks 
        'assignedLessons', # a packege has x no of lessons, this tutor has y lessons from it
    ];

    public function student() : BelongsTo 
    {
        return $this->belongsTo(Student::class, 'studentID', 'id');    
    }

    public function tutor() : BelongsTo 
    {
        return $this->belongsTo(Tutor::class, 'tutor', 'id');    
    }
}
