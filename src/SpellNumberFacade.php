<?php

namespace Palm\SpellNumber;

use Illuminate\Support\Facades\Facade;

class SpellNumberFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Spell';
    }
}
