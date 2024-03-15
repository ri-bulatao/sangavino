<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blotter\BlotterRequest;
use App\Models\Blotter;
use App\Models\Official;
use App\Services\ImageUploadService;
use Yajra\DataTables\Facades\DataTables;

class BlotterController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(Blotter::with('official')->get())
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $route_show = route('admin.blotters.show', $row);
                    $route_edit = route('admin.blotters.edit', $row);

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                <a class='dropdown-item' href='$route_show'>View</a>";

                            if(!$row->is_solved) {
                                $btn .= "
                                    <a class='dropdown-item' href='$route_edit'>Edit</a>
                                    <a class='dropdown-item' href='javascript:void(0)' onclick='c_destroy($row->id,`admin.blotters.destroy`,`.blotter_dt`)'>Delete</a>
                                ";
                            }
                           
                            $btn.="</div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.blotter.index');
    }

    public function create()
    {
        return view('admin.blotter.create', [
            'officials' => Official::pluck('name', 'id'),
        ]);
    }

    public function store(BlotterRequest $request, ImageUploadService $service)
    {
       $blotter = Blotter::create($request->validated());

       if($request->image) 
       {
          $service->handleImageUpload(model:$blotter, images:$request->image, collection:'blotter_images', conversion_name:'card', action:'create');
       }

       return to_route('admin.blotters.index')->with(['success' => 'Blotter Record Added Successfully']);
    }

    public function show(Blotter $blotter)
    {
        return view('admin.blotter.show', ['blotter' => $blotter->load('official','media')]);
    }

    public function edit(Blotter $blotter)
    {
        return view('admin.blotter.edit', [
            'blotter' => $blotter,
            'officials' => Official::pluck('name', 'id'),
        ]);
    }

    public function update(BlotterRequest $request, Blotter $blotter, ImageUploadService $service)
    {

       $blotter->update($request->validated());

       if($request->image) 
       {
          $service->handleImageUpload(model:$blotter, images:$request->image, collection:'blotter_images', conversion_name:'card', action:'update');
       }

       return to_route('admin.blotters.index')->with('success', 'Blotter Record Updated Successfully');
    }

    public function destroy(Blotter $blotter)
    {
        $blotter->delete();

       return $this->res(['success' => 'Blotter Record Deleted Successfully']);
    }
}