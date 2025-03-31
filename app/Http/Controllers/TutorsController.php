<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewMessageRequest;
use App\Http\Requests\TutorsProfileUpdator;
use App\Models\Tutor;
use App\Services\TutorsManagerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TutorsController extends Controller
{
    private $tutor;
    private $tutorsManager;

    public function __construct()
    {
        $this->tutor = Auth::user();
        # check if a tutor profile exists already & assign it to tutor
        if(Tutor::where('userID', $this->tutor->id)->first()){
            $this->tutor = Tutor::where('userID', $this->tutor->id)->first();
        }
        $this->tutorsManager = new TutorsManagerService();
    }
           
    ################## Tutors Profile ##################

    /**
     * Profile
     *
     * @return view - user profile
     */
    public function Profile()
    {
        # return tutor profile with current tutor instance
        return view('tutor.profile')->with('tutor', $this->tutor);
    }
        
    /**
     * CreateProfile
     *
     * @return view
     */
    public function CreateProfile()
    {
        return view('tutor.createProfile');
    }

    public function UpdateProfileView()
    {
        return view('tutor.updateProfile')->with('tutor', $this->tutor);
    }

    /**
     * UpdateProfile - updates/creates the tutors profile with their data
     *
     * @param  FormRequest $request - validated data
     * @return view 
     */
    public function CreateOrUpdateProfile(TutorsProfileUpdator $request)
    {
        $request = $request->validated();

        if($this->tutorsManager->CreateOrUpdateTutorsProfile($request))
        {
            # update the tutor
            $this->tutor = $this->tutor->tutor;
            return $this->Profile();
        }

        # the profile is not updated, base profile
        return $this->Profile();
    }

    ################## Messages #####################
    public function MyMessages()
    {
        return view('tutor.messages')->with('tutor', $this->tutor);
    }

    public function CreateNewMessage()
    {
        return view('tutor.newMessage');
    }

    public function GetConversation(string $coversationID)
    {
        return view('tutor.conversationView')->with('conversation', $this->tutorsManager->GetConversation($coversationID));
    }

    public function SaveNewMessage(NewMessageRequest $request)
    {
        $request = $request->validated();
        
        # save & return the conversation
        if($conversationID = $this->tutorsManager->SaveNewMessage($request)){
            return $this->GetConversation($conversationID);
        }
    }

    public function ReplyToMessage(Request $request, string $coversationID)
    {
        if($this->tutorsManager->ReplyToMessage($request)){
            # something for later
        }
        return $this->GetConversation($coversationID);
    }


    ################## Lessons ######################

    ################## Support & tickets ##############

    
    


}
