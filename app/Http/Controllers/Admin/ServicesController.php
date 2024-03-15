<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Service\ServiceRequest;
use App\Models\Service;
use Yajra\DataTables\Facades\DataTables;

class ServicesController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(Service::all())
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                <a class='dropdown-item' role='button' onclick='c_edit(`#m_service`, `.service_form :input`, [`#m_service_title`, `Edit service`], [`.btn_add_service`, `.btn_update_service`], $row)'>Edit</a>

                                <a class='dropdown-item' role='button' onclick='c_destroy($row->id,`admin.services.destroy`,`.service_dt`)'>Delete</a>
                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.service.index');
    }

    public function store(ServiceRequest $request)
    {
       Service::create($request->validated());
       return $this->res(['success' => 'Service Added Successfully']);
    }

    public function update(ServiceRequest $request, Service $service)
    {
       $service->update($request->validated());

       return $this->res(['success' => 'Service Updated Successfully']);
    }

    public function destroy(Service $service)
    {
        $service->delete();

       return $this->res(['success' => 'Service Deleted Successfully']);
    }
}
