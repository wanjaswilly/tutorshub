<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewMessageRequest;
use App\Http\Requests\TutorsProfileUpdator;
use App\Models\Tutor;
use App\Services\ChatManagementService;
use App\Services\TutorsManagerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TutorsController extends Controller
{
    private $tutor;
    private $tutorsManager;
    private $chatManager;

    public function __construct()
    {
        $this->tutor = Auth::user();
        # check if a tutor profile exists already & assign it to tutor
        if (Tutor::where('userID', $this->tutor->id)->first()) {
            $this->tutor = Tutor::where('userID', $this->tutor->id)->first();
        }
        $this->tutorsManager = new TutorsManagerService();
        $this->chatManager = new ChatManagementService();
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

    /**
     * `UpdateProfileView()` returns a form view to  update profile
     *
     * @return void
     */
    public function UpdateProfileView()
    {
        return view('tutor.updateProfile')->with('tutor', $this->tutor);
    }

    /**
     * UpdateProfile - updates/creates the tutors profile with their data
     *
     * @param  FormRequest $request - validated data
     * @return view tutors profile view
     */
    public function CreateOrUpdateProfile(TutorsProfileUpdator $request)
    {
        $request = $request->validated();

        if ($this->tutorsManager->CreateOrUpdateTutorsProfile($request)) {
            # update the tutor
            $this->tutor = $this->tutor->tutor;
            return $this->Profile();
        }

        # the profile is not updated, base profile
        return $this->Profile();
    }

    ################## Messages #####################    
    /**
     * `MyMessages()` returns a view of all chats
     *
     * @return view list of chats
     */
    public function MyMessages()
    {
        return view('tutor.messages')->with('tutor', $this->tutor);
    }

    /**
     * CreateNewMessage creates a new message
     *
     * @return view new message form
     */
    public function CreateNewMessage()
    {
        return view('tutor.newMessage');
    }

    /**
     * `GetConversation()` loads a given conversation from `MyMessages` list view 
     *
     * @param  string $coversationID conversation specifier
     * @return view a chat view with past messages & input for another message
     */
    public function GetConversation(string $coversationID)
    {
        return view('tutor.conversationView')
            ->with('conversation', $this->chatManager->GetConversation($coversationID));
    }

    public function SaveNewMessage(NewMessageRequest $request)
    {
        $request = $request->validated();

        # save & return the conversation
        if ($conversationID = $this->chatManager->SaveNewMessage($request)) {
            return $this->GetConversation($conversationID);
        }
    }

    public function ReplyToMessage(Request $request, string $coversationID)
    {
        if ($this->chatManager->ReplyToMessage($request)) {
            # something for later
        }
        return $this->GetConversation($coversationID);
    }

    ################## Packages & Students #####################
    # these show the tutors packages, with filters
    public function MyPackages()
    {
        return view('tutor.students-teaching')
            ->with(['viewPage' => 'All My', 'packages' => $this->tutor->myPackages,]);
    }
    public function ActivePackages()
    {
        return view('tutor.students-teaching')
            ->with(['viewPage' => 'Active', 'packages' => $this->tutor->myPackages,]);
    }
    public function OngoingPackages()
    {
        return view('tutor.students-teaching')
            ->with(['viewPage' => 'Ongoing', 'packages' => $this->tutor->myPackages,]);
    }
    public function CompletedPackages()
    {
        return view('tutor.students-teaching')
            ->with(['viewPage' => 'Completed', 'packages' => $this->tutor->myPackages,]);
    }

    public function TeachingPackageDetails($studentTeachingPackageID)
    {
        return view('tutor.teaching-package-details')
            ->with(['package' => $this->tutorsManager->TeachingPackageDetails($studentTeachingPackageID)]);
    }

    ################## Lessons ######################
    # lessons are a part of a teaching package


    ################## Support & tickets ##############





}
