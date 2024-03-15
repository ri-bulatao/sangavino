<?php

namespace App\Observers;

use App\Models\Blotter;
use App\Services\ActivityLogService;

class BlotterObserver
{
    public function __construct(public ActivityLogService $service)
    {

    }
    /**
     * Handle the Blotter "created" event.
     *
     * @param  \App\Models\Blotter  $blotter
     * @return void
     */
    public function created(Blotter $blotter)
    {
        $this->service->log_activity(model:$blotter, event:'added', model_name:'Blotter Report', model_property_name: "Blotter #ID $blotter->id");
    }

    /**
     * Handle the Blotter "updated" event.
     *
     * @param  \App\Models\Blotter  $blotter
     * @return void
     */
    public function updated(Blotter $blotter)
    {
        $this->service->log_activity(model:$blotter, event:'updated', model_name:'Blotter Report', model_property_name: "Blotter #ID $blotter->id");
    }

    /**
     * Handle the Blotter "deleted" event.
     *
     * @param  \App\Models\Blotter  $blotter
     * @return void
     */
    public function deleted(Blotter $blotter)
    {
        $this->service->log_activity(model:$blotter, event:'deleted', model_name:'Blotter Report', model_property_name: "Blotter #ID $blotter->id");
    }

    /**
     * Handle the Blotter "restored" event.
     *
     * @param  \App\Models\Blotter  $blotter
     * @return void
     */
    public function restored(Blotter $blotter)
    {
        //
    }

    /**
     * Handle the Blotter "force deleted" event.
     *
     * @param  \App\Models\Blotter  $blotter
     * @return void
     */
    public function forceDeleted(Blotter $blotter)
    {
        //
    }
}
