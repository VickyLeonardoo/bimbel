<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;
    protected $guarded =['id'];

    public function educationDetails()
    {
        return $this->hasMany(EducationDetail::class);
    }
    
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'instructor_courses');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
