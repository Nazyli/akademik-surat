<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class DiplomaRetrievalRequestsDetail extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'user_id',
        'request_id',
        'requirement_id',
        'user_notes',
        'size_file',
        'url_file',
        'form_status',
        'submission_date',
        'approved_date',
        'approved_by',
        'comment',
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
    public function baseNameUrl()
    {
        return isset($this->url_file) ? basename($this->url_file) : null;
    }

    public function getLabelStatus()
    {
        switch ($this->form_status) {
            case 'Sent':
                return 'info';
            case 'Cancel':
                return 'secondary';
            case 'Draft':
                return 'dark';
            case 'Reviewed':
                return 'warning';
            case 'Revisi':
                return 'danger';
            case 'Reject':
                return 'danger';
            case 'Finished':
                return 'success';
            default:
                return '';
        }
    }
}
