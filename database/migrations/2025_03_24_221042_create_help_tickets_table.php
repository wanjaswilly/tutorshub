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
        Schema::create('help_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('helpCategory'); # Technical(signup), Billing, Tutoring, Support, Others
            $table->mediumText('subject'); # summary of the issue
            $table->longText('issueDescription'); # lengthy description
            $table->json('attachments')->nullable(); # array(filenames of the attachments)
            $table->json('replies')->nullable(); # array(tracks the following): from, datetime, response, attachments
            $table->string('issueStatus')->default('Pending'); # Pending, In Progress, Solved, Flagged 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('help_tickets');
    }
};
