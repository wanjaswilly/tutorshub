<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolCategories extends Model
{
    //

    protected $fillable = [];

    public function createdBy() : BelongsTo 
    {
        return $this->belongsTo(Admin::class, 'createdBy', 'id');    
    }

    public function learningPackages() : HasMany 
    {
        return $this->hasMany(LearningPackages::class, 'schoolCategory', 'id');    
    }
}
