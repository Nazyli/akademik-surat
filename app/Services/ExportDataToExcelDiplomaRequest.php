<?php

namespace App\Services;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class ExportDataToExcelDiplomaRequest implements FromQuery, WithHeadings
{
    protected $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    public function query()
    {
        return DB::table('diploma_retrieval_requests_details as drrd')
            ->select(
                'u.first_name',
                'u.last_name',
                'u.npm',
                'u.gender',
                'u.phone',
                'u.email',
                'u.img_url',
                'u.role_id',
                'rm.name AS role_name',
                'u.department_id',
                'd.department_name',
                'u.study_program_id',
                'sp.study_program_name',
                'drr.id AS request_id',
                'drr.user_id AS request_user_id',
                'drr.form_status AS request_form_status',
                'drr.submission_date AS request_submission_date',
                'drr.processed_date AS request_processed_date',
                'drr.user_note AS request_user_note',
                'drr.comment AS request_comment',
                'drr.processed_by AS request_processed_by',
                'drr.created_by AS request_created_by',
                'drr.updated_by AS request_updated_by',
                'drr.created_at AS request_created_at',
                'drr.updated_at AS request_updated_at',
                'drrd.id AS detail_id',
                'drrd.user_id AS detail_user_id',
                'drrd.request_id AS detail_request_id',
                'drrd.requirement_id AS detail_requirement_id',
                'drrd.user_notes AS detail_user_notes',
                'drrd.size_file AS detail_size_file',
                'drrd.url_file AS detail_url_file',
                'drrd.form_status AS detail_form_status',
                'drrd.submission_date AS detail_submission_date',
                'drrd.processed_date AS detail_processed_date',
                'drrd.processed_by AS detail_processed_by',
                'drrd.comment AS detail_comment',
                'drrd.created_by AS detail_created_by',
                'drrd.updated_by AS detail_updated_by',
                'drrd.created_at AS detail_created_at',
                'drrd.updated_at AS detail_updated_at'
            )
            ->join('diploma_retrieval_requests as drr', 'drrd.request_id', '=', 'drr.id')
            ->join('users as u', 'drrd.user_id', '=', 'u.id')
            ->join('departments as d', 'u.department_id', '=', 'd.id')
            ->join('study_programs as sp', 'u.study_program_id', '=', 'sp.id')
            ->join('role_memberships as rm', 'u.role_id', '=', 'rm.id')
            ->where(DB::raw("DATE_FORMAT(drrd.created_at, '%Y-%m')"), '=', $this->date)
            ->orderBy('drrd.created_at', 'desc');
    }

    public function headings(): array
    {
        return [
            'First Name',
            'Last Name',
            'NPM',
            'Gender',
            'Phone',
            'Email',
            'Image URL',
            'Role ID',
            'Role Name',
            'Department ID',
            'Department Name',
            'Study Program ID',
            'Study Program Name',
            'Request ID',
            'Request User ID',
            'Request Form Status',
            'Request Submission Date',
            'Request Processed Date',
            'Request User Note',
            'Request Comment',
            'Request Processed By',
            'Request Created By',
            'Request Updated By',
            'Request Created At',
            'Request Updated At',
            'Detail ID',
            'Detail User ID',
            'Detail Request ID',
            'Detail Requirement ID',
            'Detail User Notes',
            'Detail Size File',
            'Detail URL File',
            'Detail Form Status',
            'Detail Submission Date',
            'Detail Processed Date',
            'Detail Processed By',
            'Detail Comment',
            'Detail Created By',
            'Detail Updated By',
            'Detail Created At',
            'Detail Updated At',
        ];
    }
}
