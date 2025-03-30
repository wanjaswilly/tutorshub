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
        Schema::create('student_tutors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('studentID')->constrained('students', 'id')->onUpdate('cascade')->onDelete('cascade'); # from students table
            $table->foreignId('tutorID')->constrained('tutors', 'id')->onUpdate('cascade')->onDelete('cascade'); # from tutors table
            $table->foreignId('studentSubscribedPackages')->constrained('student_subscribed_packages', 'id')->onUpdate('cascade')->onDelete('cascade'); # from students subscribed packages
            $table->json('subjects'); # json : subjectName, noOfLessons, grade, comments, remarks 
            $table->integer('assignedLessons'); # a packege has x no of lessons, this tutor has y lessons from it
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_tutors');
    }
};
