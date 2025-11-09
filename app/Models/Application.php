<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicationFactory> */
    use HasFactory;
    protected $fillable = [
        'job_id',
        'candidate_id',
        'applicant_name',
        'applicant_email',
        'applicant_phone',
        'linkedin_url',
        'resume_path',
        'cover_letter',
        'status',
    ];

    /**
     * العلاقة بين الابلكيشن والوظيفة
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function candidate()
    {
    return $this->belongsTo(User::class, 'candidate_id');
    }

}
