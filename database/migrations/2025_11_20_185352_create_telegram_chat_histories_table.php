<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::create('telegram_chat_histories', function (Blueprint $table) {
            $table->id();
            // chat_id es el identificador único de la conversación en Telegram.
            $table->unsignedBigInteger('chat_id')->unique(); 
            // 'history' almacena el array de mensajes de Gemini serializado como JSON.
            $table->json('history')->nullable(); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('telegram_chat_histories');
    }
};
