<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use Illuminate\Http\Request;

class TutorsController extends Controller
{
    //

    public function profile(Tutor $tutor)
    {
        return 'the profile for '.$tutor;
    }
}
