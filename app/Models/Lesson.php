<?php

namespace App\Models;

use App\Mappers\UserTypeMapper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function students()
    {
        return $this->hasManyThrough(User::class, UserLesson::class, 'lesson_id', 'id', 'id', 'user_id')->where('type', UserTypeMapper::STUDENT);
    }
}
