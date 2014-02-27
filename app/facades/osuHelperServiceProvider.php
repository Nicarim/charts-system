<?php

use Illuminate\Support\ServiceProvider;

class osuHelperServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->bind('osuHelper', function(){
            return new osu\Helper\osuHelper();
        });
    }

} 