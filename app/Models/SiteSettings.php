<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSettings extends Model
{
    protected $fillable = [
        'siteCurrency', # default dollars
        'siteCurrencySign', # default $
        'settingLanguage', # default english
        'weekStart', # sunday or monday
        'registrationTimeline', # monthly, quaterly, bi-annually, annually -->dropdown
        'tutorRegistrationAmount',  # standard tutor registration amount
        'studentRegistrationAmount', # standard student registration amount
        'tutorRegistrationOffer', # boolean
        'studentRegistrationOffer', # boolean
        'tutorRegistrationOfferAmount', # tutor registration amount on offer
        'studentRegistrationOfferAmount', # student registration amount on offer
        'useLessonTrackingWithCodes', # boolean 
    ];

}
