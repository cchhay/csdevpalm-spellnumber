<?php

return [
    /*
    *   Set the language to read
    */
    'language' => 'KH',
    /*
    *   Set the currency to read
    */
    'currency' => 'KHR',
    /*
     *  Set the limit digit to read
     */
    'digitReadLimit' => 15,
    /**
     *  Set the decimal place digit to read
     */
    'digitDegitRead' => 2,
    /*
    *   Set the value to read in your language for 1 to 19
    */
    'Read1Digit' => [
        'KH' => [
            '1' => 'មួយ',
            '2' => 'ពីរ',
            '3' => 'បី',
            '4' => 'បួន',
            '5' => 'ប្រាំ',
            '6' => 'ប្រាំមួយ',
            '7' => 'ប្រាំពីរ',
            '8' => 'ប្រាំបី',
            '9' => 'ប្រាំបួន',
            '10' => 'ដប់',
            '11' => 'ដប់មួយ',
            '12' => 'ដបពីរ',
            '13' => 'ដប់បី',
            '14' => 'ដប់បួន',
            '15' => 'ដប់ប្រាំ',
            '16' => 'ដប់ប្រាំមួយ',
            '17' => 'ដប់ប្រាំពីរ',
            '18' => 'ដប់ប្រាំបី',
            '19' => 'ដប់ប្រាំបួន',
        ],
        'EN' => [
            '1' => ' one',
            '2' => ' two',
            '3' => ' three',
            '4' => ' four',
            '5' => ' five',
            '6' => ' six',
            '7' => ' seven',
            '8' => ' eight',
            '9' => ' nine',
            '10' => ' ten',
            '11' => ' eleven',
            '12' => ' twelve',
            '13' => ' thirteen',
            '14' => ' fourteen',
            '15' => ' fifteen',
            '16' => ' sixteen',
            '17' => ' seventeen',
            '18' => ' eighteen',
            '19' => ' nineteen',
        ],
    ],
    /*
    *   Set the value to read in 2 digit
    */
    'Read2Digit' => [
        'KH' => [
            '20' => 'ម្ភៃ',
            '30' => 'សាមសិប',
            '40' => 'សែសិប',
            '50' => 'ហាសិប',
            '60' => 'ហុកសិប',
            '70' => 'ចិតសិប',
            '80' => 'ប៉ែតសិប',
            '90' => 'កៅសិប',
        ],
        'EN' => [
            '20' => ' twenty',
            '30' => ' thirty',
            '40' => ' forty',
            '50' => ' fifty',
            '60' => ' sixty',
            '70' => ' seventy',
            '80' => ' eighty',
            '90' => ' ninety',
        ],
    ],
    /*
    *   Set the value to read in 3 digit
    */
    'Read3Digit' => [
        'KH' => [
            'hundred' => 'រយ',
        ],
        'EN' => [
            'hundred' => ' hundred',
        ],
    ],
    /*
    *   Set the value to read for thousand separate
    */
    'ReadThousandDigit' => [
        'KH' => [
            1 => 'ពាន់',
            2 => 'លាន',
            3 => 'ប៊ីលាន',
            4 => 'ទ្រីលាន',
            5 => 'ក្វាទ្រីលាន',
            6 => 'គ្វីនទ្រីលាន',
            7 => 'សិចទីលាន',
            8 => 'សិបទីលាន',
            9 => 'អុកទីលាន',
            10 => 'ណូទីលាន',
            11 => 'ដេស៊ីលាន',
            12 => 'អាន់ដេស៊ីលាន',
        ],
        'EN' => [
            1 => ' thousand',
            2 => ' million',
            3 => ' billion',
            4 => ' trillion',
            5 => ' quadrillion',
            6 => ' quintillion',
            7 => ' sextillion',
            8 => ' septillion',
            9 => ' octillion',
            10 => ' nonillion',
            11 => ' decillion',
            12 => ' undecillion',
        ],
    ],
    /*
    *   Set the value for currency text
    */
    'CurrencyText' => [
        'KH' => [
            'USD' => 'ដុល្លា',
            'KHR' => 'រៀល',
        ],
        'EN' => [
            'USD' => ' dollar',
            'KHR' => ' reil',
        ],
    ],
    'FractionText' => [
        'KH' => '',
        'EN' => ' cent',
    ],
    'Case' => [
        'KH' => [
            'zero' => 'សូន្យ ',
            'negative' => 'ដក ',
            'cantread' => 'មិនអាចអានបាន',
            'and' => ' នឹង',
        ],
        'EN' => [
            'zero' => 'Zero ',
            'negative' => 'Negative ',
            'cantread' => 'Can not read',
            'and' => ' and ',
        ],
    ],
];
