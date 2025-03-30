<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TutorsController extends Controller
{
    private $tutor;

    public function __construct()
    {
        $this->tutor = Auth::user();
    }
        
    /**
     * profile
     *
     * @param  mixed $tutor
     * @return void
     */
    public function profile(Tutor $tutor)
    {
        return 'the profile for '.$tutor;
    }


}
