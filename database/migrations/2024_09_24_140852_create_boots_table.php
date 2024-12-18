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
        Schema::create('bots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('language_id')->nullable();
            $table->string('name');
            $table->string('service')->nullable();
            $table->string('role')->default('system');
            $table->string('telegram_bot')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->longText('description')->nullable();
            $table->longText('content')->nullable();
            $table->integer('active')->default(0);
            $table->string('start_message')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bots');
    }
};
