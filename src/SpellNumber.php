<?php

namespace Palm\SpellNumber;

use Exception;

class SpellNumber
{
    protected $language;
    protected $currency;
    protected $cantread;
    protected $currencyText;
    protected $fractionText;
    protected $zero;
    protected $negative;
    protected $and;
    protected $digitReadLimit;

    public function __construct($config = [])
    {
        if ($config != null) {
            if (!$config['language']) {
                throw new Exception('Please set language configuration file.');
            }
            if (!$config['currency']) {
                throw new Exception('Please set currency configuration file.');
            }
            $this->language = $config['language'];
            $this->currency = $config['currency'];
            $this->cantread = $config['cantread'];
            $this->zero = $config['zero'];
            $this->and = $config['and'];
            $this->negative = $config['negative'];
            $this->currencyText = $config['currencyText'];
            $this->fractionText = $config['fractionText'];
            $this->digitReadLimit = $config['digitReadLimit'];
        }
    }

    private function setConfig()
    {
        $language = config('spellnumber.language');
        $currency = config('spellnumber.currency');
        $this->language = $language;
        $this->currency = $currency;
        $this->digitReadLimit = config('spellnumber.digitReadLimit');
        $this->cantread = config("spellnumber.Case.$language.cantread");
        $this->zero = config("spellnumber.Case.$language.zero");
        $this->and = config("spellnumber.Case.$language.and");
        $this->negative = config("spellnumber.Case.$language.negative");
        $this->currencyText = config("spellnumber.CurrencyText.$language.$currency");
        $this->fractionText = config("spellnumber.FractionText.$language");
    }

    public function spell($number, $isCurrency = true, $decialAsFraction = false)
    {
        if (!is_numeric($number)) {
            return $this->cantread;
        }
        if ($number == 0) {
            return $this->zero.$this->currencyText;
        }
        if ($this->getLength($number) > $this->digitReadLimit) {
            return $this->cantread;
        }
        $leftText = $this->getLeftFraction($number);
        $rightText = $this->getRightFraction($number, $decialAsFraction);

        $rightTextFraction = '';
        if ($rightText != '') {
            $rightTextFraction = $rightText.$this->fractionText;
        }

        if ($number < 0) {
            if ($isCurrency) {
                return $this->negative.$leftText.$this->currencyText.$rightTextFraction;
            }

            return $this->negative.$leftText.$rightText;
        }

        if ($isCurrency) {
            return $leftText.$this->currencyText.$rightTextFraction;
        }

        return  $leftText.$rightText;
    }

    private function getLength($number)
    {
        if ($number < 0) {
            $number = substr($number, 1, strlen($number) - 1);
        }
        $arr = explode('.', $number);
        $len = substr($arr[0], 0, strlen($number));

        return strlen($len);
    }

    private function getLeftFraction($number)
    {
        // Fraction Case
        if ($number < 0) {
            $number = substr($number, 1, strlen($number) - 1);
        }
        $arr = explode('.', $number);
        if (!$arr[0]) {
            return '';
        }
        if (!$arr[0] > 0) {
            return '';
        }

        return $this->readAllDigit($arr[0]);
    }

    private function getRightFraction($number, $decialAsFraction = false)
    {
        if ($number < 0) {
            $number = substr($number, 1, strlen($number) - 1);
        }

        if (strpos($number, '.') === false) {
            return '';
        }

        $arr = explode('.', number_format($number, 2, '.', ','));

        if (!$arr[1]) {
            return '';
        }
        if (!$arr[1] > 0) {
            return '';
        }

        if ($decialAsFraction) {
            return $this->and.$arr[1].'/100';
        }

        return $this->and.$this->readAllDigit($arr[1]);
    }

    private function readThousandDigit($n)
    {
        $numberInText = '';
        $strNumber = $n;
        $length = strlen($strNumber);
        $digitCount = 0;

        if ($length == 1) {
            return $this->read1Digit($n);
        }
        if ($length == 2) {
            return $this->read2Digit($n);
        }
        if ($length == 3) {
            return $this->read3Digit($n);
        }

        while ($strNumber != '') {
            $strRight = substr($strNumber, -3); // 3 digit right
            $temp3Digit = $this->read3Digit($strRight);
            if ($temp3Digit) {
                $digitCountText = '';
                if (array_key_exists($digitCount, config("spellnumber.ReadThousandDigit.$this->language"))) {
                    $digitCountText = config("spellnumber.ReadThousandDigit.$this->language.$digitCount");
                }
                $numberInText = $temp3Digit.$digitCountText.' '.$numberInText;
            }
            if (strlen($strNumber) > 3) {
                $leftCharacter = strlen($strNumber) - 3;
                $strNumber = substr($strNumber, 0, $leftCharacter); // all digits minus 3 digits
            } else {
                $strNumber = '';
            }
            $digitCount = $digitCount + 1;
        }

        return $numberInText;
    }

    public function read3Digit($n)
    {
        if (!is_numeric($n)) {
            return $this->cantread;
        }
        $n = intval($n);
        if ($n < 100) {
            return $this->read2Digit($n);
        }
        $hundredText = config("spellnumber.Read3Digit.$this->language.hundred");

        if ($n === 100) {
            return $this->read1Digit(intval(substr("$n", 0, 1))).$hundredText;
        }

        $modHundred = $n % 100;
        $modHundredText = $this->read2Digit($modHundred);
        $hundredText = $this->read1Digit(intval(substr("$n", 0, 1))).$hundredText;

        return $hundredText.$modHundredText;
    }

    private function read2Digit($n)
    {
        if (!is_numeric($n)) {
            return $this->cantread;
        }
        $n = intval($n);
        if ($n < 20) {
            return $this->read1Digit($n);
        }
        $modTen = $n % 10;
        $modTenText = $this->read1Digit($modTen);
        $TwoNumber = ($n - $modTen);
        $TwoText = config("spellnumber.Read2Digit.$this->language.$TwoNumber");

        return $TwoText.$modTenText;
    }

    /**
     * @param number $key
     */
    private function read1Digit($n)
    {
        if (!is_numeric($n)) {
            return $this->cantread;
        }
        $n = intval($n);
        if (!$n) {
            return '';
        }

        return config("spellnumber.Read1Digit.$this->language.$n");
    }

    private function readAllDigit($number)
    {
        return $this->readThousandDigit($number);
    }
}
