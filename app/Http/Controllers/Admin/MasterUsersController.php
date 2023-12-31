<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\FormSubmission;
use App\Models\RoleMembership;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class MasterUsersController extends Controller
{
    public function index()
    {
        $departments = Department::where('status', 'Active')->orderBy('department_name')->get();
        return view('admin.users.index')
            ->with(compact('departments'));
    }

    public function getByDepartmentId(Request $request, $departmentId)
    {
        if ($request->ajax()) {
            $data = DB::table('users as u')
                ->leftJoin('role_memberships as rm', 'rm.id', '=', 'u.role_id')
                ->leftJoin(DB::raw('(SELECT SUBSTRING_INDEX(GROUP_CONCAT(id ORDER BY created_at DESC), \',\', 1) AS id, user_id FROM form_submissions GROUP BY user_id) fss'), 'u.id', '=', 'fss.user_id')
                ->leftJoin('form_submissions as fs', 'fss.id', '=', 'fs.id')
                ->leftJoin('departments as d', 'fs.department_id', '=', 'd.id')
                ->leftJoin('study_programs as sp', 'fs.study_program_id', '=', 'sp.id')
                ->select(
                    'u.id',
                    'u.img_url',
                    'u.first_name',
                    DB::raw('CONCAT(u.first_name, " ", u.last_name) AS full_name'),
                    'u.npm',
                    'u.email',
                    'u.gender',
                    'd.department_name',
                    'sp.study_program_name',
                    'rm.name as role_name',
                    'u.role_id'
                )->orderBy('full_name', 'asc');

            if ($departmentId != 0) {
                $data->where('d.id', $departmentId);
            }

            $data = $data->get();

            return FacadesDataTables::of($data)->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $badgeClass = $row->role_name === 'Admin' ? 'primary' : 'info';
                    $badge = '<span class="badge bg-label-' . $badgeClass . '">'
                        . $row->role_name . '</span>';
                    return $badge;
                })
                ->addColumn('avatar', function ($row) {
                    $image =  isset($row->img_url) ? asset($row->img_url) : asset("img/avatars/blank-profile.png");
                    return '<ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                    <li
                      data-bs-toggle="tooltip"
                      data-popup="tooltip-custom"
                      data-bs-placement="top"
                      class="avatar avatar-xs pull-up"
                      title="' . $row->full_name . '">
                      <img src="' . $image . '" alt="Avatar" class="rounded-circle" />
                    </li>
                    <li>' . $row->full_name . '</li>
                  </ul>';
                })
                ->addColumn('action', function ($row) {
                    if ($row->id == auth()->user()->id) {
                        return null;
                    }
                    $url = route('masteruser.changeRole', ['id' => $row->id, 'roleId' => ($row->role_id == 1 ? 2 : 1)]);
                    $changeRole = $row->role_id == 1 ? 'User' : 'Admin';

                    $dropdown = '<div class="dropdown">
                                    <button class="btn btn-link text-danger p-0 dropdown-toggle hide-arrow" type="button" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <form method="POST" action="' . $url . '" class="dropdown-item">
                                            ' . csrf_field() . '
                                            ' . method_field('PUT') . '
                                            <button type="submit" class="btn btn-link">
                                                <i class="bx bxs-show me-1"></i> Change Role to ' . $changeRole . '
                                            </button>
                                        </form>
                                    </div>
                                </div>';

                    return $dropdown;
                })

                ->rawColumns(['status', 'avatar', 'action'])
                ->make(true);
        }

        return view('admin.users.index');
    }


    public function changeRole(Request $request, $id, $role_id)
    {
        RoleMembership::find($role_id);
        $user = User::find($id);
        $user->update([
            'role_id' => $role_id,
            'updated_by' => auth()->user()->id,
        ]);
        return redirect()->route('masteruser.index')->with('success', 'Change role successfully.');
    }
}
