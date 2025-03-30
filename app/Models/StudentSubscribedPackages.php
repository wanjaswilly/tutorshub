<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentSubscribedPackages extends Model
{
    //

    protected $fillable = [
        'packageID', # from packages table
        'packageStatus', # Not Started, In Progress, Completed, Cancelled. 
        'remainingLessons', # no of lessons remaining
        'lessonCodes', # array(lesson unique codes) : tutorID, subject, lessonStartCode, lessonEndCode.   
    ];

    public function learningPackage() : BelongsTo 
    {
        return $this->belongsTo(LearningPackages::class, 'packageId', 'id');    
    }

    public function student() : BelongsTo
    {
        return $this->belongsTo(Student::class, 'student', 'id');
    }
}
