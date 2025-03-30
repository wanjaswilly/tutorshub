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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userID')->constrained('users','id')->onUpdate('cascade')->onDelete('cascade'); # from users table
            $table->boolean('paidRegistration')->default(false); # boolean
            $table->longText('studentBio')->nullable(); # small bio
            $table->string('currentSchool'); # pri, secondary
            $table->string('studentLocation'); # area from which
            $table->boolean('isStudentMinor')->default('false'); # boolean : -> to get parent contact, 
            $table->json('studentContact')->nullable(); # array of contacts : name & value
            # if is minor 
            $table->string('guardianName')->nullable(); # name of the guardian
            $table->string('guardianRelation'); # parent, sibling, etc 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
