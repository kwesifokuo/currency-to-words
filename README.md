# CurrencyToWords

# Usage

## Install 
``` composer install cibs/currency-to-words ```

## Create an Instance
Then in your Controller or View, you can use it with an instance. \

$currencyToWords = new \CurrencyToWords\CurrencyToWords();

## or Use
use CurrencyToWords\CurrencyToWords;

$ctw = new CurrencyToWords(); \
$amtInWords = $ctw->format(101000.56, 'en', 'Ghana Cedis', 'Pesewas');

### Parameters
String $amount = 10000.56 (Required) \
String $lang = "en" (Required) \
String $word_currency = "United States Dollars" (Required) \
String $word_unit = "Cents" (Required) \
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
'en' = English, 'fr' = French, 'es' = Spanish, etc. \
$amtInWords = $currencyToWords->format(10000.56, 'fr', 'Euros', 'Cents', 'lower');