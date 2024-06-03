<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DiplomaRetrievalRequest;
use App\Models\DiplomaRetrievalRequestsDetail;
use App\Models\FormSubmission;
use App\Models\RoleMembership;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;
use Illuminate\Support\Facades\File;
use Exception;
use Yajra\DataTables\DataTables;

class MasterUsersController extends Controller
{
    public function index()
    {
        $departments = Department::where('status', 'Active')->orderBy('department_name')->get();
        return view('layouts.users.index')
            ->with(compact('departments'));
    }

    public function getByDepartmentId(Request $request)
    {
        $departmentId = $request->input('departmentId');
        $appType = $request['app-type'];
        if ($request->ajax()) {
            $data = DB::table('users as u')
                ->leftJoin('role_memberships as rm', 'rm.id', '=', 'u.role_id')
                ->leftJoin('study_programs as sp', 'u.study_program_id', '=', 'sp.id')
                ->select(
                    'u.id',
                    'u.img_url',
                    DB::raw('CONCAT(u.first_name, " ", u.last_name) AS full_name'),
                    DB::raw('(select COUNT(*) from form_submissions fs where fs.user_id = u.id) AS total_submissions'),
                    DB::raw('(select CONCAT(
                    (select COUNT(*)
                        from diploma_retrieval_requests_details t1
                        where t1.user_id = u.id and t1.form_status ="Finished"
                    ),
                    "/",
                    (select COUNT(*)
                        from diploma_retrieval_requests_details t2
                        where t2.user_id = u.id
                    )
                )) as finished_total'),
                    'u.npm as npm',
                    'u.email',
                    'u.gender',
                    'sp.study_program_name',
                    'rm.name as role_name',
                    'u.role_id'
                )
                ->orderBy('full_name', 'asc');

            if ($departmentId != 0) {
                $data->where('u.department_id', $departmentId);
            }

            $data = $data->get();
            return FacadesDataTables::of($data)->addIndexColumn()
                ->addColumn('role_name', function ($row) {
                    return $row->role_name;
                })
                ->addColumn('status', function ($row) {
                    $badgeClass = $row->role_name === 'Admin' ? 'primary' : 'info';
                    $badge = '<span class="badge bg-label-' . $badgeClass . '">'
                        . $row->role_name . '</span>';
                    return $badge;
                })
                ->addColumn('avatar', function ($row) use ($appType) {
                    $image =  isset($row->img_url) ? asset($row->img_url) : asset("file/avatars/blank-profile.png");
                    return '<ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                    <li
                      data-bs-toggle="tooltip"
                      data-popup="tooltip-custom"
                      data-bs-placement="top"
                      class="avatar avatar-xs pull-up"
                      title="' . $row->full_name . '">
                      <img src="' . $image . '" alt="Avatar" onerror="handleImageError(this)" class="rounded-circle" />
                    </li>
                    <li> <a  style="font-size: 85%" href="' . route('masteruser.detail', $row->id) . '?app-type=' . $appType . '"> ' . $row->full_name . '</a></li>
                  </ul>';
                })
                ->addColumn('action', function ($row) use ($appType) {
                    if ($row->id == auth()->user()->id) {
                        return null;
                    }
                    if (auth()->user()->role_id == 1 && auth()->user()->id == 'administrator') {
                        $url = route('masteruser.changeRole', ['id' => $row->id, 'roleId' => ($row->role_id == 1 ? 2 : 1)]) . '?app-type=' . $appType;
                        $urlDelete = route('masteruser.destroy', $row->id) . '?app-type=' . $appType;
                        $changeRole = $row->role_id == 1 ? 'User' : 'Admin';

                        $dropdown = '<div class="dropdown">
                                    <button class="btn btn-link text-danger p-0 dropdown-toggle hide-arrow" type="button" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">

                                                                </form>

                                        <form method="POST" action="' . $url . '" class="dropdown-item">
                                            ' . csrf_field() . '
                                            ' . method_field('PUT') . '
                                            <a class="dropdown-item text-info mb-3" href="' . route('masteruser.detail', $row->id) . '?app-type=' . $appType . '">
            <i class="bx bx-detail me-1"></i> Detail
         </a>
                                            <button type="submit" class="btn btn-link">
                                                <i class="bx bxs-show me-1"></i> Change Role to ' . $changeRole . '
                                            </button>
                                        </form>
                                        <form method="POST" action="' . $urlDelete . '" class="dropdown-item">
                                            ' . csrf_field() . '
                                            ' . method_field('DELETE') . '
                                            <button type="submit" class="btn btn-link text-danger swalSuccesDeleteUser">
                                                <i class="tf-icons bx bx-trash me-1"></i> Delete User
                                            </button>
                                        </form>
                                    </div>
                                </div>';

                        return $dropdown;
                    } else {
                        $data = '<a class="btn btn-icon btn-outline-primary btn-xs border-none" href="' . route('masteruser.detail', $row->id) . '?app-type=' . $appType . '">
                                    <span class="tf-icons bx bx-detail"></span>
                                     </a>';

                        return $data;
                    };
                })

                ->rawColumns(['status', 'avatar', 'action'])
                // ->filter(function ($query) use ($request) {
                //     // Lakukan filter hanya jika ada input pencarian
                //     if ($request->has('search') && !empty($request->input('search')['value'])) {
                //         $searchValue = $request->input('search')['value'];
                //         // Lakukan filter pada kolom yang ingin Anda filter
                //         $query->where(function ($query) use ($searchValue) {
                //             $query->where('role_name', 'like', "%{$searchValue}%")
                //                 ->orWhere('email', 'like', "%{$searchValue}%");
                //             // Tambahkan filter untuk kolom lain jika diperlukan
                //         });
                //     }
                // })
                // ->orderColumn('status', 'confirmed_date $1')
                ->make(true);
        }

        return view('layouts.users.index');
    }

    public function detail(Request $request, $id)
    {
        $user = User::find($id);
        $formSubmission = FormSubmission::where('user_id', $user->id)->get();
        $diplomaRetrievalRequest = DiplomaRetrievalRequest::where('user_id', $user->id)->get();
        return view('layouts.users.detail')
            ->with(compact('user'))
            ->with(compact('formSubmission'))
            ->with(compact('diplomaRetrievalRequest'));
    }


    public function changeRole(Request $request, $id, $role_id)
    {
        $appType = $request['app-type'];
        RoleMembership::find($role_id);
        $user = User::find($id);
        $user->update([
            'role_id' => $role_id,
            'updated_by' => auth()->user()->id,
        ]);
        return redirect()->route('masteruser.index', ['app-type' => $appType])->with('success', 'Change role successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $appType = $request['app-type'];

        try {
            $periodes = DB::table('form_submissions as fs')
                ->select(DB::raw("DATE_FORMAT(fs.created_at, '%Y-%m') AS periode"))
                ->where('fs.user_id', '=', $id)
                ->groupBy(DB::raw("DATE_FORMAT(fs.created_at, '%Y-%m')"))
                ->get();

            foreach ($periodes as $p) {
                $folderName = str_replace('-', '', $p->periode);
                $publicPath = 'file/pengajuan-surat/' . $folderName . '/' . $id;
                if (File::exists($publicPath)) {
                    File::deleteDirectory($publicPath);
                }
            }

            $periodesDiploma = DB::table('diploma_retrieval_requests_details as fs')
                ->select(DB::raw("DATE_FORMAT(fs.created_at, '%Y-%m') AS periode"))
                ->where('fs.user_id', '=', $id)
                ->groupBy(DB::raw("DATE_FORMAT(fs.created_at, '%Y-%m')"))
                ->get();
            foreach ($periodesDiploma as $p) {
                $folderName = str_replace('-', '', $p->periode);
                $publicPath = 'file/skpi/' . $folderName . '/' . $id;
                if (File::exists($publicPath)) {
                    File::deleteDirectory($publicPath);
                }
            }

            DB::table('form_submissions')
                ->whereRaw("user_id = ?", $id)
                ->delete();

            DB::table('diploma_retrieval_requests_details')
                ->whereRaw("user_id = ?", $id)
                ->delete();

            DB::table('diploma_retrieval_requests')
                ->whereRaw("user_id = ?", $id)
                ->delete();

            $user = User::find($id);
            if ($user->img_url) {
                File::delete($user->img_url);
            }
            $user->delete();

            return redirect()->route('masteruser.index', ['app-type' => $appType])->with('success', 'Delete all data ' . $user->first_name . ' successfully.');
        } catch (Exception $e) {
            return redirect()->route('masteruser.index', ['app-type' => $appType])->with('error', $e->getMessage());
        }
    }
}
