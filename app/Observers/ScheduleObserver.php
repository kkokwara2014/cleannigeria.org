<?php

namespace App\Observers;

use App\Notifications\PeriodicScheduleNotification;
use App\Models\Schedule;
use App\Models\User;

class ScheduleObserver
{
    /**
     * Handle the schedule "created" event.
     *
     * @param  \App\Schedule  $schedule
     * @return void
     */
    public function created(Schedule $schedule)
    {
        $user=User::where('email','cyril.ezeaku@cleannigeria.org')->first();
        // $user->notify(new PeriodicScheduleNotification($schedule));
    }

    /**
     * Handle the schedule "updated" event.
     *
     * @param  \App\Schedule  $schedule
     * @return void
     */
    public function updated(Schedule $schedule)
    {
        //
    }

    /**
     * Handle the schedule "deleted" event.
     *
     * @param  \App\Schedule  $schedule
     * @return void
     */
    public function deleted(Schedule $schedule)
    {
        //
    }

    /**
     * Handle the schedule "restored" event.
     *
     * @param  \App\Schedule  $schedule
     * @return void
     */
    public function restored(Schedule $schedule)
    {
        //
    }

    /**
     * Handle the schedule "force deleted" event.
     *
     * @param  \App\Schedule  $schedule
     * @return void
     */
    public function forceDeleted(Schedule $schedule)
    {
        //
    }
}
