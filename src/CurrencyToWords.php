<?php

namespace Phrontlyne\Modules;

class CurrencyToWords
{
    public function format(Int $amount)
    {
        $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
        $f->setTextAttribute(\NumberFormatter::DEFAULT_RULESET, "%spellout-numbering-verbose");
        //$number = $suminsured;
        $numberParts = explode('.', (string) $amount);
        $amtInWords =  $f->format($numberParts[0]);
        if (isset($numberParts[1]) && $numberParts[1] != 00) {
            $amtInWords .= ' Ghana Cedis ' . $f->format($numberParts[1]).' Pesewas';
        } else {
            $amtInWords .= ' Ghana Cedis';
        }
        $amtInWords = strtoupper($amtInWords);
        return $amtInWords;
    }
}