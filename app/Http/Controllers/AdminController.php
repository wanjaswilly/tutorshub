<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function profile(Admin $admin)
    {
        return 'in Admin -> profile';
    }
}
