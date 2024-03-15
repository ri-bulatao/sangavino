<?php

namespace App\Http\Controllers\Admin;

use App\Models\Position;
use App\Http\Controllers\Controller;
use App\Http\Requests\Official\OfficialRequest;
use App\Http\Resources\Official\OfficialResource;
use App\Models\Official;
use App\Services\ImageUploadService;
use Yajra\DataTables\Facades\DataTables;

class OfficialController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            $officials = OfficialResource::collection(Official::with('position', 'media')->get());

            return DataTables::of($officials)
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $new_row = collect($row);

                    $route_edit = route('admin.officials.edit', $new_row['id']);

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                <a class='dropdown-item'  href='$route_edit'>Edit</a>";


                                if ($new_row['is_active'] !== 1) {
                                    $btn .= "
                                            <a class='dropdown-item' href='javascript:void(0)' 
                                            onclick='crud_activate_deactivate($new_row[id], `admin.officials.update` , `activate`, `.official_dt`, `Mark as Active`)'>Mark as Active</a>";
                                } else {
                                    $btn .= "
                                            <a class='dropdown-item' href='javascript:void(0)' 
                                            onclick='crud_activate_deactivate($new_row[id], `admin.officials.update` , `deactivate`, `.official_dt`, `Mark as Inactive`)'>Mark as Inactive</a>";
                                }


                               $btn .="<a class='dropdown-item' href='javascript:void(0)' onclick='c_destroy($new_row[id],`admin.officials.destroy`,`.official_dt`)'>Delete</a>
                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.official.index');
    }

    public function create()
    {
        return view('admin.official.create', [
            'positions' => Position::pluck('name', 'id'),
        ]);
    }

    public function store(OfficialRequest $request, ImageUploadService $service)
    {
        $official = Official::create($request->validated());

        if($request->image) {
            $service->handleImageUpload(model: $official, images: $request->image, collection:'avatar_image', conversion_name:'avatar', action:'create');
        }

        return to_route('admin.officials.index')->with(['success' => 'Official Added Successfully']);
    }

    public function edit(Official $official)
    {
        return view('admin.official.edit', [
            'official' => $official,
            'positions' => Position::pluck('name', 'id'),
        ]);
    }

  
    public function update(OfficialRequest $request, ImageUploadService $service, Official $official)
    {
        if($request->option)
        {
            // Activate || Deactivate User
            return $request->option == 'activate' ? $official->update(['is_active' => true]) : $official->update(['is_active' => false]);
        }

        $official->update($request->validated());

        if($request->image) {
            $service->handleImageUpload(model: $official, images: $request->image, collection:'avatar_image', conversion_name:'avatar', action:'update');
        }

        return to_route('admin.officials.index')->with(['success' => 'Official Update Successfully']);
    }

    public function destroy(Official $official)
    {
        $official->delete();

       return $this->res(['success' => 'Official Deleted Successfully']);
    }
}