<?php

namespace App\Observers;

use App\Models\Official;
use App\Services\ActivityLogService;

class OfficialObserver
{
    public function __construct(public ActivityLogService $service)
    {

    }

    /**
     * Handle the Official "created" event.
     *
     * @param  \App\Models\Official  $official
     * @return void
     */
    public function created(Official $official)
    {
        $this->service->log_activity(model:$official, event:'added', model_name:'Official', model_property_name: $official->name, conjunction:'an');
    }

    /**
     * Handle the Official "updated" event.
     *
     * @param  \App\Models\Official  $official
     * @return void
     */
    public function updated(Official $official)
    {
        $this->service->log_activity(model:$official, event:'updated', model_name:'Official', model_property_name: $official->name, conjunction:'an');
    }

    /**
     * Handle the Official "deleted" event.
     *
     * @param  \App\Models\Official  $official
     * @return void
     */
    public function deleted(Official $official)
    {
        $this->service->log_activity(model:$official, event:'deleted', model_name:'Official', model_property_name: $official->name, conjunction:'an');
    }

    /**
     * Handle the Official "restored" event.
     *
     * @param  \App\Models\Official  $official
     * @return void
     */
    public function restored(Official $official)
    {
        //
    }

    /**
     * Handle the Official "force deleted" event.
     *
     * @param  \App\Models\Official  $official
     * @return void
     */
    public function forceDeleted(Official $official)
    {
        //
    }
}
