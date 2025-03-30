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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userID')->constrained('users', 'id')->onUpdate('cascade')->onDelete('cascade'); # from users
            $table->string('adminLevel')->default('ADMIN'); # SUPERADMIN, ADMIN, SUPPORT, DEV
            $table->json('adminIdentification'); # Government Issued : type, value, imageName
            $table->json('adminConatcts'); # array of contacts
            $table->string('adminStatus')->default('Pending'); # Active, Deactivated, Pending
            $table->integer('createdBy')->default(1000); # default is 1000 -->system-generated
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
