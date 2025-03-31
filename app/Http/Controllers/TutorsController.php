<?php

namespace App\Http\Controllers;

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

        if($this->tutorsManager->UpdateTutorsProfile($request))
        {
            # update the tutor
            $this->tutor = $this->tutor->tutor;
            return $this->Profile();
        }

        # the profile is not updated, base profile
        return $this->Profile();
    }



}
