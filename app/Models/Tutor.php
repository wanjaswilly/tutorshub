<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tutor extends Model
{
    //
    protected $fillable = [];

    public function myStudents() : HasMany 
    {
        return $this->hasMany(StudentTutors::class, 'tutorId', 'id');    
    }

    public function myPackages() : HasMany
    {
        return $this->hasMany(StudentSubscribedPackages::class, 'taughtBy', 'id');
    }

    public function activePackages() : HasMany
    {
        return $this->myPackages()->where('status', '=', 'active');
    }

    public function completedPackages() : HasMany
    {
        return $this->myPackages()->where('status', '=', 'completed');
    }

    public function myTickets() : HasMany
    {
        return $this->hasMany(HelpTickets::class, 'createdBy', 'id');
    }

    public function openTickets() : HasMany 
    {
        return $this->myTickets()->where('status', '=', 'open');    
    }

    public function closedTickets() : HasMany 
    {
        return $this->myTickets()->where('status', '=', 'closed');    
    }

}
