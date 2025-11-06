<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobView extends Model
{
    /** @use HasFactory<\Database\Factories\JobViewFactory> */
    use HasFactory;

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
