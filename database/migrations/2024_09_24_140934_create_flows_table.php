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
        Schema::create('flows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bot_id')->nullable();
            $table->integer('sort')->default(0);
            $table->string('name')->nullable();
            $table->string('url')->nullable();
            $table->longText('description')->nullable();
            $table->json('addAnswerBefore')->nullable();
            $table->json('addKeyword')->nullable();
            $table->json('addAnswer')->nullable();
            $table->json('addAnswerNext')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('bot_id')->references('id')->on('bots')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flows');
    }
};
