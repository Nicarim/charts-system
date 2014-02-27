<?php

use Illuminate\Support\ServiceProvider;

class osuHelperServiceProvider extends ServiceProvider {

    public function register()
    {
        // Register 'underlyingclass' instance container to our UnderlyingClass object
        $this->app['osuHelper'] = $this->app->share(function($app)
        {
            return new osu\Helper\osuHelper;
        });

        // Shortcut so developers don't need to add an Alias in app/config/app.php
        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('osuHelper', 'osu\Helper\osuHelper');
        });
    }

} 