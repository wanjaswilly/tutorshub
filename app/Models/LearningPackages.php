<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningPackages extends Model
{
    //

    protected $fillable = [

    ];

    public function schoolCategory()
    {
        return $this->belongsTo(SchoolCategories::class, 'schoolCategory', 'id');
    }
}
