<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // حدد الحقول اللي هتتخزن
    protected $fillable = [
        'user_id',
        'commentable_id',
        'commentable_type',
        'body', // اسم العمود في قاعدة البيانات
    ];

    // علاقة باليوزر
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // علاقة polymorphic للجوب أو أي شيء قابل للتعليق
    public function commentable()
    {
        return $this->morphTo();
    }
}
