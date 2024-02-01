# CurrencyToWords

# Usage

## Create an Instance
$currencyToWords = new \CurrencyToWords\CurrencyToWords();

### Parameters
String $amount = 10000.56 (Required)
String $lang = "en" (Required)
String $word_currency = "United States Dollars" (Required)
String $word_unit = "Cents" (Required)
String $case = "default" (Optional)

** Currency should be changed to your preferred currency words and word units **

## For Default case using ucwords()
$amtInWords = $currencyToWords->format(10000.56, 'en', 'Ghana Cedis', 'Pesewas');

## For Uppercase using strtoupper()
$amtInWords = $currencyToWords->format(10000.56, 'en', 'Ghana Cedis', 'Pesewas', 'upper');

## For Lowercase using strtolower()
$amtInWords = $currencyToWords->format(10000.56, 'en', 'Ghana Cedis', 'Pesewas', 'lower');

## For Different Languages using PHP NumberFormatter::getLocale
### Example
'en' = English, 'fr' = French, 'es' = Spanish, etc.
$amtInWords = $currencyToWords->format(10000.56, 'fr', 'Euros', 'Cents', 'lower');