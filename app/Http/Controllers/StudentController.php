<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //

    public function profile(Student $student)
    {
        return 'in student->profile';
    }
}
