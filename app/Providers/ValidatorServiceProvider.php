<?php

namespace Yeayurdev\Providers;

use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['validator']->extend('twitchUrl', function($attribute, $value, $parameters, $messages)
        {
            $url = $value;
            $twitch_haystack = array('https://www.twitch.tv/', 'https://twitch.tv/');

                // Check the user's input against each array value

                foreach ($twitch_haystack as $twitch_haystack)
                {
                    if (strpos($url, $twitch_haystack) !== FALSE)
                    {
                        // If request URL passes the haystack, check that it returns HTTP response 200
                        $urlHeaders = get_headers($url, 1);

                        if ($urlHeaders[0] == 'HTTP/1.1 200 OK') {
                            return TRUE;
                        }
                            return FALSE;
                    }
                    return FALSE;
                }   

            
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
