<?php

namespace App\Http\Controllers\Resident;

use App\Models\Request;
use App\Models\Service;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServicesRequest\ServicesRequest;
use App\Models\Official;
use App\Services\PaypalService;
use Yajra\DataTables\Facades\DataTables;

class RequestController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(Request::with('service')->whereNotNull('transaction_id')->whereBelongsTo(auth()->user())->orderBy('status', 'DESC')->get())
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $route_show = route('resident.requests.show', $row);
                    $route_edit = route('resident.requests.edit', $row);

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                            <a class='dropdown-item' href='$route_show'>View</a>";

                                if($row->status == Request::PENDING)
                                {
                                    $btn .= "<a class='dropdown-item' href='$route_edit'>Edit</a>

                                             <a class='dropdown-item' href='javascript:void(0)' onclick='c_destroy($row->id,`resident.requests.destroy`,`.request_dt`)'>Delete</a>";
                                }

                            $btn .= "</div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('resident.request.index');
    }

    public function create()
    {
       return view('resident.request.create', [
        'services' => Service::all(),
        'secretary' => Official::byPosition('Barangay Secretary')->active()->first(),
       ]);
    }

    public function store(ServicesRequest $request, PaypalService $service)
    {
       $new_request = auth()->user()->requests()->create($request->validated());

       $this->log_activity(model:$new_request, event:'requested', model_name: 'Service', model_property_name: $new_request->service->name);

       return to_route('resident.requests.index')->with(['success' => 'Service Requested Successfully. You will be receiving an email and sms notification once there is an update from your request.']);
    }

    public function show(Request $request)
    {
        return view('resident.request.show', ['request' => $request->load('service')]);
    }

    public function edit(Request $request)
    {
       return view('resident.request.edit', [
        'request' => $request,
        'services' => Service::all(),
        'secretary' => Official::byPosition('Barangay Secretary')->active()->first(),
       ]);
    }

    public function update(ServicesRequest $services_request, Request $request)
    {
       $request->update($services_request->validated());

       $this->log_activity(model:$request, event:'updated a requested', model_name: 'Service', model_property_name: $request->service->name);

       return $this->res(['success' => 'Request Updated Successfully']);
    }

    public function destroy(Request $request)
    {
       $this->log_activity(model:$request, event:'deleted a requested', model_name: 'Service', model_property_name: $request->service->name);

       $request->delete();

       return $this->res(['success' => 'Request Deleted Successfully']);
    }

}