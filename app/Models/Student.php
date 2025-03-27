<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{

    protected $fillable = [];


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
