<?php

namespace App\Helpers;

class textHelper
{
    /**
     * Formata texto que pode estar em diferentes formatos
     * (string simples, JSON array, ou array PHP)
     *
     * @param mixed $text
     * @return string
     */
    public static function formatText($text): string
    {
        // Se for null ou vazio
        if (empty($text)) {
            return '';
        }

        // Se já for string simples (não JSON)
        if (is_string($text) && !self::isJson($text)) {
            return e($text); // Escapa HTML
        }

        // Se for array, junta com espaço
        if (is_array($text)) {
            return e(implode(' ', $text));
        }

        // Se for string JSON, decodifica
        if (is_string($text) && self::isJson($text)) {
            $decoded = json_decode($text, true);
            if (is_array($decoded)) {
                return e(implode(' ', $decoded));
            }
        }

        // Fallback: converte para string
        return e((string) $text);
    }

    /**
     * Verifica se uma string é JSON válido
     *
     * @param string $string
     * @return bool
     */
    private static function isJson(string $string): bool
    {
        if (empty($string)) {
            return false;
        }

        // JSON deve começar com [ ou {
        $firstChar = trim($string)[0] ?? '';
        if (!in_array($firstChar, ['[', '{'])) {
            return false;
        }

        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
