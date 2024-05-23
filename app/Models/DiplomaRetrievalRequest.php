<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class DiplomaRetrievalRequest extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'user_id',
        'form_status',
        'submission_date',
        'processed_date',
        'user_note',
        'comment',
        'processed_by',
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

    public function getLabelStatus()
    {
        switch ($this->form_status) {
            case 'Sent':
                return 'info';
            case 'Not Processed':
                return 'dark';
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

    public function getLabelStatusAdmin()
    {
        switch ($this->form_status) {
            case 'Sent':
                return 'primary';
            case 'Not Processed':
                return 'dark';
            case 'Draft':
                return 'dark';
            case 'Reviewed':
                return 'warning';
            case 'Revisi':
                return 'info';
            case 'Reject':
                return 'danger';
            case 'Finished':
                return 'success';
            default:
                return '';
        }
    }

    public function getUpdatedByUserFirstName()
    {
        $user = User::find($this->updated_by);
        if ($user) {
            $first_name_parts = explode(' ', $user->first_name);
            return $first_name_parts[0];
        }
        return '';
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
