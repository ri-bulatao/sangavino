<?php

namespace App\Http\Controllers\Admin;

use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Purok\PurokRequest;
use App\Models\Purok;

class PurokController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(Purok::all())
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                <a class='dropdown-item' role='button' onclick='c_edit(`#m_purok`, `.purok_form :input`, [`#m_purok_title`, `Edit purok`], [`.btn_add_purok`, `.btn_update_purok`], $row)'>Edit</a>

                                <a class='dropdown-item' role='button' onclick='c_destroy($row->id,`admin.puroks.destroy`,`.purok_dt`)'>Delete</a>
                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.purok.index');
    }

    public function store(PurokRequest $request)
    {
       Purok::create($request->validated());

       return $this->res(['success' => 'Purok Added Successfully']);
    }

    public function update(PurokRequest $request, Purok $purok)
    {
       $purok->update($request->validated());

       return $this->res(['success' => 'Purok Updated Successfully']);
    }

    public function destroy(Purok $purok)
    {
        $purok->delete();

       return $this->res(['success' => 'Purok Deleted Successfully']);
    }
}
