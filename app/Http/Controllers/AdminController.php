<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\LearningPackages;
use App\Models\SchoolCategories;
use App\Models\Student;
use App\Models\StudentSubscribedPackages;
use App\Models\Tutor;
use App\Models\User;
use App\Models\UsersPayments;
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
        if ($request->isMethod('get')) {
            return view('admin.createSchoolCategory');
        }

        # handle post request

    }

    public function CreateTeachingPackages(Request $request)
    {
        # handle get request
        if ($request->isMethod('get')) {
            return view('admin.createTeachingPackages');
        }
    }

    public function ManuallyVerifyPayments()
    {
        # show all the payments that are not verified
        return view('admin.manuallyValidatePayments')->with('usersPayments', UsersPayments::where('paymentStatus', 'Not-Verified')->get());
    }
    
    /**
     * UpdateUserPayments - updates a given payment with payment details
     * 
     *
     * @param  mixed $request - contains payments details
     * @return view ManuallyVerifyPayments view
     */
    public function UpdateUserPayments(Request $request)
    {
        return $this->ManuallyVerifyPayments();
    }

    ######################## BASE MASS VIEWS ######################
    
    /**
     * ViewAllTutors - list all tutors
     *
     * @return view all tutors
     */
    public function ViewAllTutors()
    {
        return view('admin.viewAllTutors')->with('tutors', User::where('userType','Tutor')->get());
    }
    
    /**
     * ViewAllStudents - list all students
     *
     * @return view all students
     */
    public function ViewAllStudents()
    {
        return view('admin.viewAllStudents')->with('students', User::where('userType','Student')->get());
    }
    
    /**
     * ViewAllParents - lists all parents and their signed up children
     *
     * @return view all parents and their registered children
     */
    public function ViewAllParents()
    {
        return view('admin.viewAllParents')->with('students', User::where('userType','Parent')->get());
    }
    
    /**
     * ViewAllLearningPackages - show all learning packages, their prices and terms
     *
     * @return view all packages
     */
    public function ViewAllLearningPackages()
    {
        return view('admin.viewAllLearningPackages')->with('learningPackages', LearningPackages::all());
    }
    
    /**
     * ViewAllSchoolCategories - lists all school categories
     *
     * @return view all school categories and their description & (optional ->the available packages)
     */
    public function ViewAllSchoolCategories()
    {
        return view('admin.viewAllSchoolCategories')->with('schoolCategories', SchoolCategories::all());
    }


    ################# TUTORS VIEWS  #####################
    
    /**
     * ViewTutorProfile - shows a tutors profile and optin to ban/disable 
     *
     * @param  Tutor $tutor - tutor's id
     * @return view view of the tutors profile
     */
    public function ViewTutorProfile(Tutor $tutor)
    {
        return view('admin.viewTutorProfile')->with('tutor', $tutor);
    }
    
    /**
     * BanATutor - bans a given tuto for a given period of time or indefnately
     *
     * @param  Tutor $tutor tutor's id
     * @return view tutor's profile view
     */
    public function BanATutor(Request $request, Tutor $tutor)
    {
        # ban the tutor for this period
        # return their profile
        return $this->ViewTutorProfile($tutor->id);
    }
    
    /**
     * ViewTutorsStudents - lists all students the tutor is teaching and 
     *  different packages each student has with the tutor
     *
     * @param  Tutor $tutor tutor's id
     * @return view all students and their packages
     */
    public function ViewTutorsStudents(Tutor $tutor)
    {
        return view('admin.viewTutorsStudents')->with('tutorsStudents', $tutor->myStudents);
    }
    
    /**
     * ViewTutorsStudentLessons -show lessons of a given student subscribed package
     *
     * @param  StudentSubscribedPackage $subscribedPackage - an id of the package and then its data is loaded automatically 
     * @return view a given student's package lessons(a package has lessons inside it)
     */
    public function ViewTutorsStudentLessons(StudentSubscribedPackages $subscribedPackage)
    {
        return view('admin.viewTutorsStudentLessons')->with('studentLessons', $subscribedPackage);
    }


    ################ STUDENTS VIEWS ####################
    public function ViewStudentProfile(Student $student)
    {
        return view('admin.viewStudentProfile')->with('student', $student);
    }
}
