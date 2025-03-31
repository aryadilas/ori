<?php

namespace App\Observers;

use App\Models\Skdr;

class SkdrObserver
{
    /**
     * Handle the Skdr "created" event.
     */
    public function created(Skdr $skdr): void
    {
        //
    }

    /**
     * Handle the Skdr "updated" event.
     */
    public function updated(Skdr $skdr): void
    {
        //
    }

    /**
     * Handle the Skdr "deleted" event.
     */
    public function deleted(Skdr $skdr): void
    {
        //
    }

    /**
     * Handle the Skdr "restored" event.
     */
    public function restored(Skdr $skdr): void
    {
        //
    }

    /**
     * Handle the Skdr "force deleted" event.
     */
    public function forceDeleted(Skdr $skdr): void
    {
        //
    }
}
