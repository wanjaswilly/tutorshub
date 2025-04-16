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
        Schema::create('student_subscribed_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('packageID')->constrained('learning_packages', 'id')->onUpdate('cascade')->onDelete('cascade'); # from packages table
            $table->string('packageStatus')->default('Not Started'); # Not Started, In Progress, Completed, Cancelled. 
            $table->integer('remainingLessons'); # no of lessons remaining
            $table->json('lessonCodes')->nullable(); # array(lesson unique codes) : tutorID, subject, lessonStartCode, lessonEndCode.
            $table->foreignId('studentID')->constrained('students', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_subscribed_packages');
    }
};
