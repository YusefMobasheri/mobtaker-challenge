<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function users()
    {
        return $this->hasMany(User::class, 'school_id', 'id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'school_id', 'id');
    }
}
