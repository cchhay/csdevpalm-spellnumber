#SpellNumber package

##This package spell number (currency or just number) in to your prefer language

##Install <b>composer require csdevpalm/palm-spell-number</b>

##Update config/app.php <b>Palm\SpellNumber\SpellNumberServiceProvider::class,</b>

##Public Vendor Configuration <b>php artisan vendor:publish</b>

##Use
    <pre>
        SpellNumber::spell($number,$asCurrency = true,$decialShowAsFraction = false);

        SpellNumber::spell(1582.58);
        SpellNumber::spell(1582.58,false);
        SpellNumber::spell(1582.58,true,true);
    </pre>
