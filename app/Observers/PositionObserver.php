<?php

namespace App\Observers;

use App\Models\Position;
use App\Services\ActivityLogService;

class PositionObserver
{
    public function __construct(public ActivityLogService $service)
    {

    }

    /**
     * Handle the Position "created" event.
     *
     * @param  \App\Models\Position  $position
     * @return void
     */
    public function created(Position $position)
    {
        $this->service->log_activity(model:$position, event:'added', model_name:'Position', model_property_name: $position->name);
    }

    /**
     * Handle the Position "updated" event.
     *
     * @param  \App\Models\Position  $position
     * @return void
     */
    public function updated(Position $position)
    {
        $this->service->log_activity(model:$position, event:'updated', model_name:'Position', model_property_name: $position->name);
    }

    /**
     * Handle the Position "deleted" event.
     *
     * @param  \App\Models\Position  $position
     * @return void
     */
    public function deleted(Position $position)
    {
        $this->service->log_activity(model:$position, event:'deleted', model_name:'Position', model_property_name: $position->name);
    }

    /**
     * Handle the Position "restored" event.
     *
     * @param  \App\Models\Position  $position
     * @return void
     */
    public function restored(Position $position)
    {
        //
    }

    /**
     * Handle the Position "force deleted" event.
     *
     * @param  \App\Models\Position  $position
     * @return void
     */
    public function forceDeleted(Position $position)
    {
        //
    }
}
