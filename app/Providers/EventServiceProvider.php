<?php

namespace Yeayurdev\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Yeayurdev\Events\UserHasPostedMessage' => [
            'Yeayurdev\Listeners\showUserMessage',
        ],

        'Yeayurdev\Events\UserNotificationFollow' => [
            'Yeayurdev\Listeners\ShowNotificationFollow',
        ],

        'Yeayurdev\Events\UserNotificationPost' => [
            'Yeayurdev\Listeners\ShowNotificationPost',
        ],

        'Yeayurdev\Events\UserNotificationLike' => [
            'Yeayurdev\Listeners\ShowNotificationLike',
        ],

        'Yeayurdev\Events\FanNotificationPost' => [
            'Yeayurdev\Listeners\ShowFanNotificationPost',
        ],

        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            'SocialiteProviders\Twitch\TwitchExtendSocialite@handle',
            'SocialiteProviders\YouTube\YouTubeExtendSocialite@handle',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
