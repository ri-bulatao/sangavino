<?php

namespace App\Http\Controllers\Admin;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Position\PositionRequest;

class PositionController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(Position::all())
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $route_edit = route('admin.positions.edit', $row);

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                <a class='dropdown-item' role='button' href='$route_edit'>Edit</a>

                                <a class='dropdown-item' role='button' onclick='c_destroy($row->id,`admin.positions.destroy`,`.position_dt`)'>Delete</a>
                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.position.index');
    }

    public function create()
    {
        return $this->res(['results' => Position::all()]);
    }

    public function store(PositionRequest $request)
    {
        Position::create($request->validated());

        return $this->res(['success' => 'Position Added Successfully']);
    }

    public function edit(Position $position)
    {
        return view('admin.position.edit', ['parent_positions' => Position::pluck('name', 'id'), 'position' => $position]);
    }

    public function update(PositionRequest $request, Position $position)
    {
        $position->update($request->validated());

        return to_route('admin.positions.index')->with('success', 'Position Updated Successfully');
    }

    public function destroy(Position $position)
    {
        $position->delete();

       return $this->res(['success' => 'Position Deleted Successfully']);
    }
}
