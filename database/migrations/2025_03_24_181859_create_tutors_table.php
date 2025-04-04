<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tutors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userID')->constrained('users', 'id')->onUpdate('cascade')->onDelete('cascade'); # from users table
            $table->string('tutorProfileImage'); # file name
            $table->string('tutorResume'); # uploaded cv/resume name
            $table->json('tutorsPackages'); # array : packageID, lessons, 
            $table->json('otherTutorServices')->nullable(); # apart from normal lessons, what do they offer : serviceName, serviceDescription, serviceCost 
            $table->boolean('paidCurrentSubscription')->default(false); # boolean
            $table->longText('tutorsBio'); # tutors self description
            $table->json('tutorsExperience')->nullable(); # like taught or coached : title, startDate, endDate, workingHere, entityName, duties/activities 
            $table->json('tutorsContacts'); # array of contact details : type & value
            $table->json('tutorsIdentification'); # Government issued : type, number, imageName
            $table->string('tutorsLocation');
            $table->boolean('showContactDetails')->default(true); # display conatct details
            $table->string('tutorAvailabilityStatus')->default('Offline'); # available, fully-booked, offline
            $table->integer('tutorMessageCount')->default(0); # counts all tutors unread messages
            $table->boolean('isTutorApproved')->default(false); # allowed to start tutoring
            # in the case of suspended
            $table->boolean('isTutorSuspended')->default(false); # boolean
            $table->json('suspensionReason')->nullable(); # array : datetime, studentID, ticketID, adminID, reasonForSuspension,  
            $table->date('returnDate')->nullable(); # date of return
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutors');
    }
};
