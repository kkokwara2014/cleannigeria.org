<?php

namespace App\Observers;

use App\Machinemaint;
use App\Notifications\MachinemaintNotification;
use App\User;


class MachinemaintObserver
{
    /**
     * Handle the machinemaint "created" event.
     *
     * @param  \App\Machinemaint  $machinemaint
     * @return void
     */
    public function created(Machinemaint $machinemaint)
    {
        $user=User::where('email','cyril.ezeaku@cleannigeria.org')->first();
        // $user->notify(new MachinemaintNotification($machinemaint));

        // Notification::send($user,new MachinemaintNotification($machinemaint));
    }

    /**
     * Handle the machinemaint "updated" event.
     *
     * @param  \App\Machinemaint  $machinemaint
     * @return void
     */
    public function updated(Machinemaint $machinemaint)
    {
        //
    }

    /**
     * Handle the machinemaint "deleted" event.
     *
     * @param  \App\Machinemaint  $machinemaint
     * @return void
     */
    public function deleted(Machinemaint $machinemaint)
    {
        //
    }

    /**
     * Handle the machinemaint "restored" event.
     *
     * @param  \App\Machinemaint  $machinemaint
     * @return void
     */
    public function restored(Machinemaint $machinemaint)
    {
        //
    }

    /**
     * Handle the machinemaint "force deleted" event.
     *
     * @param  \App\Machinemaint  $machinemaint
     * @return void
     */
    public function forceDeleted(Machinemaint $machinemaint)
    {
        //
    }
}
