<?php

namespace Phrontlyne\Modules;

class CurrencyToWords
{
    public function format(String $amount, String $case = "upper", String $currency)
    {
        $word_currency = "Ghana Cedis";
        $word_unit = "Pesewas";

        if($currency == 'USD') {
            $word_currency = "Dollars";
            $word_unit = "Cents";
        } elseif($currency == 'EUR') {
            $word_currency = "Euros";
            $word_unit = "Cents";
        } elseif($currency == 'GBP') {
            $word_currency = "Pounds";
            $word_unit = "Pence";
        }
        $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
        $f->setTextAttribute(\NumberFormatter::DEFAULT_RULESET, "%spellout-numbering-verbose");
        //$number = $suminsured;
        $numberParts = explode('.', $amount); //(string)
        $amtInWords =  $f->format($numberParts[0]);
        if (isset($numberParts[1]) && $numberParts[1] != 00) {
            $amtInWords .= ' '.$word_currency.' ' . $f->format($numberParts[1]).' '.$word_unit;
        } else {
            $amtInWords .= ' '.$word_currency;
        }
        $amtInWords = $case == 'upper' ? strtoupper($amtInWords) : ucwords($amtInWords);
        return $amtInWords;
    }
}