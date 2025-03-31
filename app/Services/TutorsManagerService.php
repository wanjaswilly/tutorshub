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
     * SaveNewMessage - saves new message
     *
     * @param  mixed $newMessage new message's data
     * @return bool saved message to database
     */
    public function SaveNewMessage($newMessage) : bool
    {
        # load the tutors messages
        # create the conversation ID in this format: 'userID_StudentSubscribedPackeID_number'
        # add the new message: create a new user entry in this manner 
            # 'userID_StudentSubscribedPackeID_number': {datetime, message, replyTo(nullable), attachments} 
        # update the json
        
        if(true){
            return true;
        }

        return false;

    }
    
    /**
     * ReplyToMessage - replies to a given message
     *
     * @param  mixed $reply reply data
     * @return bool saved the reply
     */
    public function ReplyToMessage($reply) :bool
    {
        # load the tutors messages
        # get the conversation & add the reply message
        # update the json

        if(true){
            return true;
        }
        return false;
    }
    
    /**
     * GetConversation - returns a given conversation in messages
     *
     * @param  mixed $conversationID unique identifier of the conversation
     * @return array
     */
    public function GetConversation(string $conversationID) :array
    {
        # load all messages
        # get the conversation & return it
        return [];
    }
}
