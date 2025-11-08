<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobView extends Model
{
    /** @use HasFactory<\Database\Factories\JobViewFactory> */
    use HasFactory;

    protected $fillable = ['job_id', 'user_id', 'user_agent', 'ip_address'];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
