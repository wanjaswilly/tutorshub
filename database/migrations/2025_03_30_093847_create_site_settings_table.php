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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('siteCurrency')->default('Dollars'); # default dollars
            $table->string('siteCurrencySign')->default('$'); # default $
            $table->string('settingLanguage')->default('English'); # default english
            $table->string('weekStart')->default('Monday'); # sunday or monday
            $table->string('registrationTimeline')->default('Yearly'); # monthly, quaterly, bi-annually, annually -->dropdown
            $table->float('tutorRegistrationAmount');  # standard tutor registration amount
            $table->float('studentRegistrationAmount'); # standard student registration amount
            $table->boolean('tutorRegistrationOffer')->default(false); # boolean
            $table->boolean('studentRegistrationOffer')->default(false); # boolean
            $table->float('tutorRegistrationOfferAmount'); # tutor registration amount on offer
            $table->float('studentRegistrationOfferAmount'); # student registration amount on offer
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
