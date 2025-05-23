<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'code',
        'price',
        'slug',
        'session',
        'active',
    ];

    public function instructors()
    {
        return $this->belongsToMany(Instructor::class, 'instructor_courses');
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }


    
}
