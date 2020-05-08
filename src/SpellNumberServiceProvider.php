<?php

namespace Palm\SpellNumber;

use Illuminate\Support\ServiceProvider;

class SpellNumberServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
    }

    public function register()
    {
        $this->registerPublishables();
        $this->registerBindings();
    }

    /**
     * Public configuration file into laravel configuration path.
     */
    private function registerPublishables()
    {
        // $basePath = dirname(__DIR__);

        $arrayPublishable = [
            'config' => [
                __DIR__.'./config/config.php' => config_path('spellnumber.php'),
            ],
        ];
        foreach ($arrayPublishable as $publish => $paths) {
            $this->publishes($paths, $publish);
        }
    }

    /**
     * Register spellnumber Number Class into service provider with it configuration setting.
     */
    protected function registerBindings()
    {
        $this->app->singleton('SpellNumber', function () {
            $language = config('spellnumber.language');
            $currency = config('spellnumber.currency');

            $config = [];
            $config['language'] = config('spellnumber.language');
            $config['currency'] = config('spellnumber.currency');
            $config['cantread'] = config("spellnumber.Case.$language.cantread");
            $config['zero'] = config("spellnumber.Case.$language.zero");
            $config['and'] = config("spellnumber.Case.$language.and");
            $config['negative'] = config("spellnumber.Case.$language.negative");
            $config['currencyText'] = config("spellnumber.CurrencyText.$language.$currency");
            $config['fractionText'] = config("spellnumber.FractionText.$language");
            $config['digitReadLimit'] = config('spellnumber.digitReadLimit');

            return new SpellNumber($config);
        });
    }

    protected function registerConfiguration()
    {
    }

    /**
     * Helper to get the config values.
     *
     * @param string $key
     * @param string $default
     *
     * @return mixed
     */
    protected function config($key, $default = null)
    {
        return config("spellnumber.$key", $default);
    }

    // /**
    //  * Get an instantiable configuration instance.
    //  *
    //  * @param  string  $key
    //  *
    //  * @return mixed
    //  */
    // protected function getConfigInstance($key)
    // {
    //     $instance = $this->config($key);

    //     if (is_string($instance)) {
    //         return $this->app->make($instance);
    //     }

    //     return $instance;
    // }
}
