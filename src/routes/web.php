<?php

use Illuminate\Support\Facades\Route;

Route::get('spell', function () {
    return Spell::spell(23250.2363);
});
