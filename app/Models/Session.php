<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function year(){
        return $this->belongsTo(Year::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function attendance(){
        return $this->hasMany(Attendance::class);
    }

    public function child(){
        return $this->hasMany(Child::class);
    }
}
