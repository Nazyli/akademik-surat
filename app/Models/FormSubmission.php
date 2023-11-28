<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class FormSubmission extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'user_id',
        'form_status',
        'department_id',
        'study_program_id',
        'form_template_id',
        'size_file',
        'url_file',
        'signed_file',
        'signed_size_file',
        'submission_date',
        'keterangan',
        'komentar',
        'created_by',
        'updated_by',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function pathUrl()
    {
        return isset($this->url_file) ? asset($this->url_file) : null;
    }
    public function pathSignedFile()
    {
        return isset($this->signed_file) ? asset($this->signed_file) : null;
    }

    public function signedFileName()
    {
        return basename($this->signed_file);
    }

    public function user()
    {
        return User::find($this->user_id);
    }

    public function department()
    {
        return Department::find($this->department_id);
    }

    public function studyProgram()
    {
        return StudyProgram::find($this->study_program_id);
    }
    public function formTemplate()
    {
        return FormTemplates::find($this->form_template_id);
    }
    public function getLabelStatus()
    {
        switch ($this->form_status) {
            case 'Sent':
                return 'bg-label-primary';
            case 'Cancel':
                return 'bg-label-secondary';
            case 'Draft':
                return 'bg-label-dark';
            case 'Reviewed':
                return 'bg-label-warning';
            case 'Revisi':
                return 'bg-label-info';
            case 'Reject':
                return 'bg-label-danger';
            case 'Finished':
                return 'bg-label-success';
            default:
                return '';
        }
    }

    public function getLabelStatusAdmin()
    {
        switch ($this->form_status) {
            case 'Sent':
                return 'bg-label-dark';
            case 'Cancel':
                return 'bg-label-secondary';
            case 'Draft':
                return 'bg-label-dark';
            case 'Reviewed':
                return 'bg-label-warning';
            case 'Revisi':
                return 'bg-label-info';
            case 'Reject':
                return 'bg-label-danger';
            case 'Finished':
                return 'bg-label-success';
            default:
                return '';
        }
    }
    public function getFormStatusAdmin()
    {
        if ($this->form_status == 'Sent') {
            return "Not Processed";
        } else {
            return $this->form_status;
        }
    }
}
