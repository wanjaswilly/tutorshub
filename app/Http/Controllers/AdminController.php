<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Services\AdminManagementService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $adminManager;

    public function __construct()
    {
        $this->adminManager = new AdminManagementService();
    }

    public function profile(Admin $admin)
    {
        return 'in Admin -> profile';
    }

    public function CreateSchoolCategories(Request $request)
    {
        # handle get request
        if($request->isMethod('get')){
            return view('admin.createSchoolCategory');
        }

        # handle post request
        


    }
}
