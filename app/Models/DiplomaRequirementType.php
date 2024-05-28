<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class DiplomaRequirementType extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'requirement',
        'requirement_en',
        'description',
        'description_en',
        'degree',
        'status',
        'sort_order',
        'required',
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

    public function findRequestUser($id)
    {
        $user = User::find(auth()->user()->id);
        $requestDetail = DiplomaRetrievalRequestsDetail::where('user_id', $user->id)
            ->where('request_id', $id)
            ->where('requirement_id', $this->id)
            ->first();
        return $requestDetail;
    }
}
