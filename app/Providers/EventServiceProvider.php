<?php

namespace App\Providers;

use App\Models\Machinemaint;
use App\Models\Schedule;
use App\Observers\MachinemaintObserver;
use App\Observers\ScheduleObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        'App\Events\LeaveEvent' => [
            'App\Listeners\SendLeaveEmailListener',
        ],
        'App\Events\NewStaffEvent' => [
            'App\Listeners\SendNewStaffEmailListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        
         //registering observers
         Schedule::observe(ScheduleObserver::class);

         Machinemaint::observe(MachinemaintObserver::class);
    }
}
