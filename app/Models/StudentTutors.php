<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StudentTutors extends Model
{
    protected $fillable = [
        'studentID', # from students table
        'tutorID', # from tutors table
        'studentSubscribedPackage', # id from students subscribed packages
        'subjects', # json : subjectName, noOfLessons, grade, comments, remarks 
        'assignedLessons', # a packege has x no of lessons, this tutor has y lessons from it
    ];

    public function student() : BelongsTo 
    {
        return $this->belongsTo(Student::class, 'studentID', 'id');    
    }

    public function tutor() : BelongsTo 
    {
        return $this->belongsTo(Tutor::class, 'tutorID', 'id');    
    }

    public function subscribedPackage() : HasOne
    {
        return $this->hasOne(StudentSubscribedPackages::class, 'id', 'studentSubscribedPackage');
    }

}
