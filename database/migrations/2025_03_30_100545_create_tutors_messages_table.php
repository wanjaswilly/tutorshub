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
        Schema::create('tutors_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userID')->constrained('users', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->json('messages'); # json : from, studentTutorsID(chat in reference), date, time, message, reply, status(read/unread)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutors_messages');
    }
};
