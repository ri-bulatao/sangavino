<?php

namespace App\Observers;

use App\Models\Purok;
use App\Services\ActivityLogService;

class PurokObserver
{
    public function __construct(public ActivityLogService $service)
    {

    }

    /**
     * Handle the Purok "created" event.
     *
     * @param  \App\Models\Purok  $purok
     * @return void
     */
    public function created(Purok $purok)
    {
        $this->service->log_activity(model:$purok, event:'added', model_name:'Purok', model_property_name: $purok->name);
    }

    /**
     * Handle the Purok "updated" event.
     *
     * @param  \App\Models\Purok  $purok
     * @return void
     */
    public function updated(Purok $purok)
    {
        $this->service->log_activity(model:$purok, event:'updated', model_name:'Purok', model_property_name: $purok->name);
    }

    /**
     * Handle the Purok "deleted" event.
     *
     * @param  \App\Models\Purok  $purok
     * @return void
     */
    public function deleted(Purok $purok)
    {
        $this->service->log_activity(model:$purok, event:'deleted', model_name:'Purok', model_property_name: $purok->name);
    }

    /**
     * Handle the Purok "restored" event.
     *
     * @param  \App\Models\Purok  $purok
     * @return void
     */
    public function restored(Purok $purok)
    {
        //
    }

    /**
     * Handle the Purok "force deleted" event.
     *
     * @param  \App\Models\Purok  $purok
     * @return void
     */
    public function forceDeleted(Purok $purok)
    {
        //
    }
}
