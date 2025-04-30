<?php

namespace CurrencyToWords;

class CurrencyToWords
{
    /**
     * Currency mappings with full names and units
     * 
     * @var array
     */
    protected static $currencyMappings = [
        'GH¢' => ['currency' => 'Ghana Cedis', 'unit' => 'Pesewas'],
        'USD' => ['currency' => 'United States Dollars', 'unit' => 'Cents'],
        'GBP' => ['currency' => 'British Pounds', 'unit' => 'Pence'],
        'EUR' => ['currency' => 'Euros', 'unit' => 'Cents'],
    ];

    /**
     * Default currency code if not specified
     * 
     * @var string
     */
    protected static $defaultCurrencyCode = 'GH¢';

    /**
     * Convert a numeric amount to words with currency
     *
     * @param string $amount The amount to format (e.g. "1234.56")
     * @param string $currencyCode The currency code (e.g. "USD", "GBP")
     * @param string $lang The language code for formatting (default: "en")
     * @param string $case The text case: "upper", "lower", or "default" (title case)
     * @return string The formatted amount in words
     */
    public function format(string $amount, string $currencyCode = null, string $lang = "en", string $case = "default")
    {
        // Get currency information
        $currencyInfo = $this->getCurrencyInfo($currencyCode);
        $wordCurrency = $currencyInfo['currency'];
        $wordUnit = $currencyInfo['unit'];

        // Format the number as words
        $f = new \NumberFormatter($lang, \NumberFormatter::SPELLOUT);
        $f->setTextAttribute(\NumberFormatter::DEFAULT_RULESET, "%spellout-numbering-verbose");

        // Split amount into whole number and decimal parts
        $numberParts = explode('.', $amount);
        $amtInWords = $f->format($numberParts[0]);

        // Add currency and units if decimal part exists
        if (isset($numberParts[1]) && $numberParts[1] != '00') {
            $amtInWords .= ' ' . $wordCurrency . ' ' . $f->format($numberParts[1]) . ' ' . $wordUnit;
        } else {
            $amtInWords .= ' ' . $wordCurrency;
        }

        // Apply case formatting
        return $this->applyCase($amtInWords, $case);
    }

    /**
     * Get currency information based on currency code
     *
     * @param string|null $currencyCode
     * @return array
     */
    protected function getCurrencyInfo(?string $currencyCode): array
    {
        // If currency code is null or not found, use default
        if ($currencyCode === null || !isset(self::$currencyMappings[$currencyCode])) {
            $currencyCode = self::$defaultCurrencyCode;
        }

        return self::$currencyMappings[$currencyCode];
    }

    /**
     * Apply case formatting to the string
     *
     * @param string $text
     * @param string $case
     * @return string
     */
    protected function applyCase(string $text, string $case): string
    {
        switch ($case) {
            case 'upper':
                return strtoupper($text);
            case 'lower':
                return strtolower($text);
            default:
                return ucwords($text);
        }
    }

    /**
     * Add a custom currency to the mappings
     *
     * @param string $code
     * @param string $currencyName
     * @param string $unitName
     * @return void
     */
    public static function addCurrency(string $code, string $currencyName, string $unitName): void
    {
        self::$currencyMappings[$code] = [
            'currency' => $currencyName,
            'unit' => $unitName
        ];
    }

    /**
     * Set the default currency code
     *
     * @param string $code
     * @return void
     */
    public static function setDefaultCurrency(string $code): void
    {
        if (isset(self::$currencyMappings[$code])) {
            self::$defaultCurrencyCode = $code;
        }
    }
}