<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{

    protected $fillable = [
        'userID', # from users table
        'paidRegistration', # boolean
        'studentBio', # small bio
        'currentSchool', # pri, secondary
        'studentLocation', # area from which
        'isStudentMinor', # boolean : -> to get parent contact, 
        'studentContact', # array of contacts : name & value
        # if is minor 
        'guardianName', # name of the guardian
        'guardianRelation', # parent, sibling, etc 
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'userID', 'id');
    }

    public function learningPackages() : HasMany 
    {
        return $this->hasMany(StudentSubscribedPackages::class, 'learningStudent', 'id');    
    }

    public function myTutors() :HasMany
    {
        return $this->hasMany(StudentTutors::class, 'learningSTudent', 'id');
    }

    public function activePackages() : HasMany
    {
        return $this->learningPackages()->where('status', '=', 'active');
    }

    public function completedPackages() : HasMany
    {
        return $this->learningPackages()->where('status', '=', 'completed');
    }




}
