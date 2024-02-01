<?php

namespace CurrencyToWords;

class CurrencyToWords
{
    public function format(String $amount, String $lang = "en", String $word_currency, String $word_unit, String $case = "default")
    {
        $f = new \NumberFormatter($lang, \NumberFormatter::SPELLOUT);
        $f->setTextAttribute(\NumberFormatter::DEFAULT_RULESET, "%spellout-numbering-verbose");

        $numberParts = explode('.', $amount);
        $amtInWords =  $f->format($numberParts[0]);

        if (isset($numberParts[1]) && $numberParts[1] != 00) {
            $amtInWords .= ' '.$word_currency.' ' . $f->format($numberParts[1]).' '.$word_unit;
        } else {
            $amtInWords .= ' '.$word_currency;
        }
        switch ($case) {
            case 'upper':
                $amtInWords = strtoupper($amtInWords);
                break;
            case 'lower':
                $amtInWords = strtolower($amtInWords);
                break;
            default:
                $amtInWords = ucwords($amtInWords);
                break;
        }
        
        return $amtInWords;
    }
}