<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StudentSubscribedPackages extends Model
{
    //

    protected $fillable = [
        'packageID', # from packages table
        'packageStatus', # Not Started, In Progress, Completed, Cancelled. 
        'remainingLessons', # no of lessons remaining
        'lessonCodes', # array(lesson unique codes) : tutorID, subject, lessonStartCode, lessonEndCode. 
        'studentID', # from students table  
    ];

    public function learningPackage() : BelongsTo 
    {
        return $this->belongsTo(LearningPackages::class, 'packageId', 'id');    
    }

    public function student() : BelongsTo
    {
        return $this->belongsTo(Student::class, 'studentID', 'id');
    }

    public function studentTutor() :HasOne
    {
        return $this->hasOne(StudentTutors::class, 'studentSubscribedPackage', 'id');
    }
}
