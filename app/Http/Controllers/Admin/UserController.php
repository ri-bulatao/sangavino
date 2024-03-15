<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;
use App\Mail\AccountUpdate;

class UserController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            $users = UserResource::collection(User::with('role')->whereRelation('role', 'name', 'resident')->get());

            return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('actions', function($row)
            {
                $new_row = collect($row);

                $btn = "
                <div class='dropdown'>
                    <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    <i class='fas fa-ellipsis-v'></i>
                    </a>
                    <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>";

                    if ($row['is_activated'] !== 1) {
                        $btn .= "
                                <a class='dropdown-item' href='javascript:void(0)' 
                                onclick='crud_activate_deactivate($new_row[id], `admin.users.update` , `activate`, `.user_dt`, `Activate this Account`)'>Activate Account</a>";
                    } else {
                        $btn .= "
                                <a class='dropdown-item' href='javascript:void(0)' 
                                onclick='crud_activate_deactivate($new_row[id], `admin.users.update` , `deactivate`, `.user_dt`, `Deactivate this Account`)'>Deactivate Account</a>";
                    }

                    $btn.=    "<a class='dropdown-item' role='button' onclick='c_destroy($new_row[id],`admin.users.destroy`,`.user_dt`)'>Delete</a>
                    </div>
                </div> ";

               return $btn;
           })
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('admin.user.index');
    }

    public function update(User $user)
    {
        request('option') == 'activate' ? $user->update(['is_activated' => true]) : $user->update(['is_activated' => false]);

        $this->log_activity(model:$user, event:request('option').'d', model_name: 'User Account', model_property_name: $user->resident->full_name);

        Mail::to($user)->send( new AccountUpdate($user));  // email user

        return true;
    }

    public function destroy(User $user)
    {
        $user->delete();

        return $this->res(['success' => 'User Acount Deleted Successfully']);
    }
}