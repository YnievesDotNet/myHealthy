<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\NewRegisteredUser' => [
            'App\Handlers\Events\LinkUserToExistingContacts',
            'App\Handlers\Events\SendMailUserWelcome',
        ],
        'App\Events\NewBooking' => [
            'App\Handlers\Events\SendBookingNotification',
        ],
        'YnievesDotNet\FourStream\Events\ConnectionOpen' => [
            'YnievesDotNet\FourStream\Handlers\Events\ConnectionOpen',
        ],
        'YnievesDotNet\FourStream\Events\MessageReceived' => [
            'YnievesDotNet\FourStream\Handlers\Events\MessageReceived',
        ],
        'YnievesDotNet\FourStream\Events\BinaryMessageReceived' => [
            'YnievesDotNet\FourStream\Handlers\Events\BinaryMessageReceived',
        ],
        'YnievesDotNet\FourStream\Events\PingReceived' => [
            'YnievesDotNet\FourStream\Handlers\Events\PingReceived',
        ],
        'YnievesDotNet\FourStream\Events\ErrorGenerated' => [
            'YnievesDotNet\FourStream\Handlers\Events\ErrorGenerated',
        ],
        'YnievesDotNet\FourStream\Events\ConnectionClose' => [
            'YnievesDotNet\FourStream\Handlers\Events\ConnectionClose',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
    }
}
