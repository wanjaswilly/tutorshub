<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningPackages extends Model
{
    //

    protected $fillable = [
        'packageName', # name of the package --> basic, standard, pro
        'schoolCategoryID', # load from school categories
        'numberOfLessons', # the required amount o lessons
        'SubjectsAvailable', # list addable by tutors, to what they teach
        'packagePrice', # price
        'packageDescription', # what the package is about
        'packageOnOffer', # boolean
        'packageOfferPrice', # cost while on offer 
    ];

    public function schoolCategory()
    {
        return $this->belongsTo(SchoolCategories::class, 'schoolCategory', 'id');
    }
}
