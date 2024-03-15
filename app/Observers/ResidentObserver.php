<?php

namespace App\Observers;

use App\Models\Resident;
use App\Services\ActivityLogService;

class ResidentObserver
{
    public function __construct(public ActivityLogService $service)
    {

    }

    /**
     * Handle the Resident "created" event.
     *
     * @param  \App\Models\Resident  $resident
     * @return void
     */
    public function created(Resident $resident)
    {
        $this->service->log_activity(model:$resident, event:'added', model_name:'Resident', model_property_name: $resident->full_name);
    }

    /**
     * Handle the Resident "updated" event.
     *
     * @param  \App\Models\Resident  $resident
     * @return void
     */
    public function updated(Resident $resident)
    {
        $this->service->log_activity(model:$resident, event:'updated', model_name:'Resident', model_property_name: $resident->full_name);
    }

    /**
     * Handle the Resident "deleted" event.
     *
     * @param  \App\Models\Resident  $resident
     * @return void
     */
    public function deleted(Resident $resident)
    {
        $this->service->log_activity(model:$resident, event:'deleted', model_name:'Resident', model_property_name: $resident->full_name);
    }

    /**
     * Handle the Resident "restored" event.
     *
     * @param  \App\Models\Resident  $resident
     * @return void
     */
    public function restored(Resident $resident)
    {
        //
    }

    /**
     * Handle the Resident "force deleted" event.
     *
     * @param  \App\Models\Resident  $resident
     * @return void
     */
    public function forceDeleted(Resident $resident)
    {
        //
    }
}
