<?php

namespace App\Observers;

use App\Models\Service;
use App\Services\ActivityLogService;

class ServiceObserver
{
    public function __construct(public ActivityLogService $activitylog_service)
    {

    }

    /**
     * Handle the Service "created" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function created(Service $service)
    {
        $this->activitylog_service->log_activity(model:$service, event:'added', model_name:'Service', model_property_name: $service->name);
    }

    /**
     * Handle the Service "updated" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function updated(Service $service)
    {
        $this->activitylog_service->log_activity(model:$service, event:'updated', model_name:'Service', model_property_name: $service->name);
    }

    /**
     * Handle the Service "deleted" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function deleted(Service $service)
    {
        $this->activitylog_service->log_activity(model:$service, event:'deleted', model_name:'Service', model_property_name: $service->name);
    }

    /**
     * Handle the Service "restored" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function restored(Service $service)
    {
        //
    }

    /**
     * Handle the Service "force deleted" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function forceDeleted(Service $service)
    {
        //
    }
}
