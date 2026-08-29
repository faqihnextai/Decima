<?php

if (!function_exists('t')) {
    /**
     * Helper singkat untuk memanggil terjemahan bahasa
     * Contoh penggunaan: t('Nav.about')
     */
    function t(string $line, array $replace = [], ?string $locale = null): string
    {
        return lang($line, $replace, $locale);
    }
}