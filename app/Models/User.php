<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use PDO;

// class User extends Authenticatable implements MustVerifyEmail
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $keyType = 'string';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'npm',
        'gender',
        'phone',
        'class',
        'class_year',
        'semester_graduate',
        'whatsapp',
        'department_id',
        'study_program_id',
        'img_url',
        'role_id',
        'status',
        'email',
        'password',
        'created_by',
        'updated_by',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function role()
    {
        return $this->belongsTo(RoleMembership::class);
    }

    public function getRole()
    {
        return RoleMembership::where('id', $this->role_id)->first();
    }

    public function getGender()
    {
        if ($this->gender == 'L') {
            return 'Laki - Laki';
        } else if ($this->gender == 'P') {
            return 'Perempuan';
        } else {
            return null;
        }
    }

    public function fullName()
    {
        return $this->first_name  . ' ' . $this->last_name;
    }

    public function imgUrl()
    {
        return isset($this->img_url) ? asset($this->img_url) : asset("file/avatars/blank-profile.png");
    }
    public function department()
    {
        $departement = Department::find($this->department_id);
        if ($departement == null) {
            return new Department();
        }

        return $departement;
    }

    public function studyProgram()
    {
        $studyProgram = StudyProgram::find($this->study_program_id);
        if ($studyProgram == null) {
            return new StudyProgram;
        }
        return;
    }

    public function getDegree()
    {
        return Str::substr($this->studyProgram()->study_program_name, 0, 2);
    }

    public function getSemester()
    {
        $text = $this->semester_graduate;
        if ($text == null) {
            return null;
        }
        $parts = explode(' ', $text);
        $semester = $parts[0];
        $year = $parts[1];
        return $semester;
    }

    public function getAcademicYear()
    {
        $text = $this->semester_graduate;
        if ($text == null) {
            return null;
        }
        $parts = explode(' ', $text);
        $semester = $parts[0];
        $year = $parts[1];
        return $year;
    }
}
