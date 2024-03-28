<?php 

namespace App\Services;

use App\Mail\SendRequestUpdate;
use App\Models\Request;
use App\Services\TextService;
use Illuminate\Support\Facades\Mail;


class RequestService {

    public function __construct(public TextService $service, public ActivityLogService $activity_log_service)
    {
        
    }

    public function notify(Request $request)
    {
        $this->service->send(request: $request); // send text

        $status = $request->status == Request::APPROVED ? "approved" : "declined";

        $requestor = $request->user->resident->full_name;

        $this->activity_log_service->log_activity(model:$request, event:"$status", model_name:'Service Request', model_property_name: "Requestor: $requestor "); // activitylogs
        
        $text_service->custom_send($request->user, 'Your request has been ' . $status . '.');

        return Mail::to($request->user->email)->send(new SendRequestUpdate($request));
    }
}