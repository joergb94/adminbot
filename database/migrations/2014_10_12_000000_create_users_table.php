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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_type_id')->default(2);
            $table->string('name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('find_out')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('verification_token')->nullable()->unique();
            $table->string('verification_code')->nullable()->unique();
            $table->string('verification_sent_at')->nullable()->unique();
            $table->boolean('verified')->default(0);
            $table->string('password');
            $table->boolean('accept_terms')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_type_id')->references('id')->on('user_types')->onDelete('cascade');  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
