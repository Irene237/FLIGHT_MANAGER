<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
        'description',
    ];

    /**
     * Récupérer la valeur d'un paramètre.
     */
    public static function getValue(string $key, $default = null)
    {
        return static::where('key', $key)->value('value') ?? $default;
    }

    /**
     * Enregistrer ou mettre à jour un paramètre.
     */
    public static function setValue(
        string $key,
        $value,
        string $group = 'general',
        string $type = 'text',
        ?string $description = null
    ): void {
        static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'group' => $group,
                'type' => $type,
                'description' => $description,
            ]
        );
    }
}