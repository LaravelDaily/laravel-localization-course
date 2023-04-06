<?php

if (!function_exists('formatCurrency')) {
    function formatCurrency($amount, $locale = 'en_US', $currency = 'USD')
    {
        $formatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($amount, $currency);
    }
}