<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tutor extends Model
{
    //
    protected $fillable = [
        'userID', # from users table
        'tutorProfileImage', # file name
        'tutorResume', # uploaded cv/resume
        'tutorsPackages', # array : packageID, lessons, 
        'otherTutorServices', # apart from normal lessons, what do they offer
        'paidCurrentSubscription', # boolean
        'tutorsBio', # tutors self description
        'tutorsExperience', # like taught or coached
        'tutorsContacts', # array of contact details 
        'tutorsIdentification', # Government issued 
        'tutorsLocation',  # where the tutor is from
        'showContactDetails', # display conatct details
        'tutorAvailabilityStatus', # available, fully-booked, offline
        'tutorMessageCount', # counts all tutors unread messages
        'isTutorApproved', # allowed to start tutoring
        # in the case of suspended
        'isTutorSuspended', # boolean
        'suspensionReason', # array : datetime, studentID, ticketID, adminID, reasonForSuspension,  
        'returnDate', # date of return
    ];

    public function user()
    {
        $this->belongsTo(User::class, 'userID', 'id');
    }

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
