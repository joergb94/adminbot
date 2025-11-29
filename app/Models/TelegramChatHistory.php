<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Google\Gemini\Data\Content;
use Google\Gemini\Data\Part;
use Google\Gemini\Enums\Role;

class TelegramChatHistory extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'telegram_chat_histories';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'chat_id',
        'history',
    ];

    // Castear 'history' como un array. Laravel se encarga de serializar 
    // y deserializar entre JSON (DB) y array (PHP).
    protected $casts = [
        'history' => 'array',
    ];


    /**
     * Método CRUCIAL: Convierte el array almacenado en la DB a un array 
     * de objetos Content de Gemini para inyectar el contexto al chat.
     *
     * @return array<Content>
     */
    public function getGeminiHistory(): array
    {
        $geminiHistory = [];

        // Obtener el historial como un array de PHP (gracias al $casts = ['history' => 'array'])
        $rawHistory = $this->history ?? [];

        foreach ($rawHistory as $item) {
            
            // 1. Mapear las partes (asumimos solo partes de texto para este ejemplo)
            $parts = array_map(function ($partData) {
                // Las partes de texto se almacenan típicamente como ['text' => 'el texto']
                // También puede haber partes de imagen, pero esta lógica es para texto.
                return new Part(text: $partData['text'] ?? ''); 
            }, $item['parts'] ?? []);

            if (empty($parts) || !isset($item['role'])) {
                continue; 
            }
            
            // 2. Usar el rol (user o model)
            $role = Role::tryFrom($item['role']);

            // 3. Crear el objeto Content que el cliente de Gemini necesita
            if ($role) {
                $geminiHistory[] = new Content(
                    role: $role,
                    parts: $parts
                );
            }
        }

        return $geminiHistory;
    }
    
    /**
     * Método auxiliar para serializar el historial de objetos Content a un array
     * que se pueda guardar en la base de datos (antes de que Laravel lo convierta a JSON).
     *
     * @param array<Content> $history
     * @return array
     */
    public static function serializeHistory(array $history): array
    {
        return array_map(function (Content $content) {
            // El Content object implementa JsonSerializable, pero a veces es mejor 
            // usar una representación de array simple si el casteo a JSON falla la estructura.
            return [
                'role' => $content->role->value,
                // Asumimos que Part tiene una propiedad de texto, o lo serializamos.
                'parts' => array_map(function (Part $part) {
                     return ['text' => $part->text ?? ''];
                }, $content->parts)
            ];
        }, $history);
    }
}