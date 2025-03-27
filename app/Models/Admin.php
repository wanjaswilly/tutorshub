<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //

    protected $filleable = [

    ];


    public function helpTickets()
    {
        return $this->hasMany(HelpTickets::class, 'assignedTo', 'id');
    }

    public function schools()
    {
        return $this->hasMany(SchoolCategories::class, 'createdBy', 'id');
    }

    public function packages()
    {
        return $this->hasMany(LearningPackages::class, 'createdBy', 'id');
    }
}
