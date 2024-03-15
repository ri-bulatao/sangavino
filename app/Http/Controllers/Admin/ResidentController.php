<?php

namespace App\Http\Controllers\Admin;

use App\Models\Purok;
use App\Models\Resident;
use Illuminate\Http\Request;
use App\Services\ResidentService;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Resident\ResidentRequest;
use App\Http\Resources\Resident\ResidentResource;

class ResidentController extends Controller
{
    public function index(Request $request)
    {
        if(request()->ajax())
        {
            $residents = ResidentResource::collection(Resident::query()
                ->with('purok')
                ->when($request->has('status'), fn($q) => $q->where('is_voter', $request->status))
                ->get()
            );

            return DataTables::of($residents)
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $new_row = collect($row);
                    $route_edit = route('admin.residents.edit', $new_row['id']);

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                <a class='dropdown-item'  href='$route_edit'>Edit</a>

                                <a class='dropdown-item'  href='javascript:void(0)' onclick='c_destroy($new_row[id],`admin.residents.destroy`,`.resident_dt`)'>Delete</a>
                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.resident.index');
    }

    public function create()
    {
        return $this->res(['results' => Purok::all()]);
    }

    public function store(ResidentRequest $request, ResidentService $service)
    {
       $resident = Resident::create($request->validated());

       if($request->filled('email'))
       {
            $service->create_account(resident: $resident, email: $request->email);
       }

       return $this->res(['success' => 'Resident Added Successfully']);
    }

    public function edit(Resident $resident)
    {
        return view('admin.resident.edit', [
            'puroks' => Purok::pluck('name', 'id'),
            'resident' => $resident
        ]);
    }

    public function update(ResidentRequest $request, Resident $resident)
    {
       $resident->update($request->validated());

       if($request->filled('email'))
       {
            $resident->user()->updateOrCreate(
                ['role_id' => 2],
                ['email' => $request->email],
            );
       }

       return to_route('admin.residents.index')->with('success', 'Resident Updated Successfully');
    }


    public function destroy(Resident $resident)
    {
        $resident->delete();

       return $this->res(['success' => 'Resident Deleted Successfully']);
    }
}