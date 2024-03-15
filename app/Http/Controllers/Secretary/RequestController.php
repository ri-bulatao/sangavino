<?php

namespace App\Http\Controllers\Secretary;

use App\Models\Request;
use App\Models\Service;
use App\Models\Official;
use App\Models\Resident;
use App\Services\RequestService;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request as HttpRequest;
use App\Http\Resources\Request\RequestResource;
use App\Http\Requests\ServicesRequest\ServicesRequest;

class RequestController extends Controller
{
    public function index(HttpRequest $request)
    {
        if(request()->ajax())
        {
            $requests = RequestResource::collection(
                Request::query()
                ->when($request->filled('service') && $request->service !== '0', fn($query) => $query->where('service_id', $request->service))
                ->with('service', 'user.resident')
                ->orderBy('status', 'DESC')
                ->get()
            );

            return DataTables::of($requests)
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $new_row = collect($row);

                    $route_show = route('secretary.requests.show', $new_row['id']);
                    $route_edit = route('secretary.requests.edit', $new_row['id']);

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                            <a class='dropdown-item' href='$route_show'>View</a>
                            <a class='dropdown-item' href='$route_edit'>Edit</a>

                          </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('secretary.request.index', [
            'services' => Service::has('requests')->pluck('name', 'id'),
        ]);
    }

    public function create()
    {
        return view('secretary.request.create', ['residents' => Resident::has('user')->with('user')->get(), 'services' => Service::pluck('name', 'id')]);
    }

    public function store(ServicesRequest $request,)
    {
        $request = Request::create($request->validated() + ['status' => 1]);

        $requestor = $request->user->resident->full_name;

        $this->log_activity(model:$request, event:'added', model_name:'Service Request', model_property_name: "Requestor: $requestor ");

        return to_route('secretary.requests.index')->with('success', 'Request Added Successfully');
    }

    public function show(Request $request)
    {
        return view('secretary.request.show', [
            'request' => $request->load('service'), 
            'punong_barangay' => Official::whereRelation('position', 'name', 'Punong Barangay')->first()
        ]);
    }

    public function print(Request $request)
    {
        return view('secretary.request.pdf', [
            'request' => $request->load('service'), 
            'punong_barangay' => Official::whereRelation('position', 'name', 'SK Chairman')->first()
        ]);

    }

    public function edit(Request $request)
    {
        return view('secretary.request.edit', ['request' => $request]);
    }

    public function update(Request $request, RequestService $service)
    {
        $request->update(request()->validate(['status' => 'required', 'remark' => 'sometimes']));

        $service->notify(request: $request->load('user.resident', 'service')); // notify 

        return to_route('secretary.requests.index')->with('success', 'Request Updated Successfully');
    }

}