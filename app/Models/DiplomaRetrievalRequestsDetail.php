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
        'requirement',
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
}
