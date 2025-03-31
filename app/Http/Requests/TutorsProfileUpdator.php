<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TutorsProfileUpdator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'tutorProfileImage'=> ['required','photo'], # file name
        'tutorResume' => ['required'], # uploaded cv/resume
        'tutorsPackages' => ['required'], # array : packageID, lessons, 
        'tutorsBio' => ['required','min:200'], # tutors self description
        'tutorsContacts' => ['required'], # array of contact details 
        'tutorsIdentification' => ['required'], # Government issued 
        'tutorsLocation' => ['required'],  # where the tutor is from
        'tutorAvailabilityStatus' => ['required'], # available, fully-booked, offline
        ];
    }
}
