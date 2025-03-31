<?php

namespace App\Services;

use App\Models\Tutor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TutorsManagerService
{
    private $tutor;

    public function __construct()
    {
        $this->tutor = Auth::user();
    }

    public function UpdateTutorsProfile($profileData)
    {
        # save the profileImage, resume, identification
        $profileImageName = '';
        $resumeFileName = '';
        $identificationFileName = '';
        $tutorsIdentificationData = json_encode([
            'identificationType' => $profileData['tutorsIdentification']['identificationType'],
            'identificationNumber' => $profileData['tutorsIdentification']['identificationType'],
            'identificationFileName' => $identificationFileName,
        ]);

        $tutorProfile = Tutor::updateOrCreate([
            'userID' => $this->tutor->id, # from users table
            'tutorProfileImage' => $profileImageName, # file name
            'tutorResume' => $resumeFileName, # uploaded cv/resume
            'tutorsPackages' => $profileData['tutorsPackages'], # array : packageID, lessons, 
            'otherTutorServices' => $profileData['otherTutorServices'], # apart from normal lessons, what do they offer
            'tutorsBio' => $profileData['tutorsBio'], # tutors self description
            'tutorsExperience' => $profileData['tutorsExperience'], # like taught or coached
            'tutorsContacts' => $profileData['tutorsContacts'], # array of contact details 
            'tutorsIdentification' => $tutorsIdentificationData, # Government issued 
            'tutorsLocation' => $profileData['tutorsLocation'],  # where the tutor is from
            'showContactDetails' => $profileData['showContactDetails'], # display conatct details
            'tutorAvailabilityStatus' => $profileData['tutorAvailabilityStatus'], # available, fully-booked, offline
        ]);
        if ($tutorProfile != null) {
            Session::flash('message', 'Profile Upadted Successfully.');
            return true;
        }

        Session::flash('error', "An error occured while updating your profile");
        return false;
    }
}
