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
        Schema::create('user_type_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mat', 3)->default('TUD');
            $table->unsignedBigInteger('user_type_id')->nullable();
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->softDeletes();

            //foreing key 
            $table->foreign('user_type_id')->references('id')->on('user_types')->onDelete('cascade');  
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_type_details');
    }
};
