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
        Schema::create('learning_packages', function (Blueprint $table) {
            $table->id();
            $table->string('packageName'); # name of the package --> basic, standard, pro
            $table->foreignId('schoolCategoryID')->constrained('school_categories', 'id')->onUpdate('cascade')->onDelete('cascade'); # load from school categories
            $table->integer('numberOfLessons'); # the required amount o lessons
            $table->json('SubjectsAvailable'); # list addable by tutors, to what they teach
            $table->float('packagePrice'); # price
            $table->mediumText('packageDescription'); # what the package is about
            $table->boolean('packageOnOffer')->default(false); # boolean
            $table->float('packageOfferPrice')->nullable(); # cost while on offer 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_packages');
    }
};
