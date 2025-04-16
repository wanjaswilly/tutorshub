<?php

namespace App\Services;

use App\Models\StudentSubscribedPackages;
use App\Models\Tutor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TutorsManagerService
{
    private $tutor;

    public function __construct()
    {
        $this->tutor = Auth::user();
        # check if a tutor profile exists already & assign it to tutor
        if(Tutor::where('userID', $this->tutor->id)->first()){
            $this->tutor = Tutor::where('userID', $this->tutor->id)->first();
        }
    }
    
    /**
     * CreateOrUpdateTutorsProfile - same function to update/create tutors profile
     *
     * @param  mixed $profileData the tutor's data
     * @return bool saved the data to dtatabase
     */
    public function CreateOrUpdateTutorsProfile($profileData) :bool
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
    
    /**
     * TutoringStudents gets all students the tutor is teaching & the package details
     *
     * @return eloquent-object all students for the tutor
     */
    public function TutoringStudents()
    {
        return $this->tutor->myPackages();
    }
    
    /**
     * `TeachingPackageDetails()` gets a student teaching package details
     *
     * @param  mixed $studentTeachingPackageID
     * @return eloquent-object package details
     */
    public function TeachingPackageDetails($studentTeachingPackageID) : mixed 
    {
        return StudentSubscribedPackages::find($studentTeachingPackageID);    
    }

    ############ Lessons ################
    public function NewLesson($studentTutorsID)
    {
        # load package details from student tutors
        # if code based is enabled, generate code, send to student
        # save code
    }
    
}
