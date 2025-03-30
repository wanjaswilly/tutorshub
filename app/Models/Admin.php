<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //

    protected $filleable = [
        'userID', # from users
        'adminLevel', # SUPERADMIN, ADMIN, SUPPORT, DEV
        'adminIdentification', # Government Issued : type, value, imageName
        'adminConatcts', # array of contacts
        'adminStatus', # Active, Deactivated, Pending
        'createdBy', # super admin -->from admins table :default is 1000 -->system-generated
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
