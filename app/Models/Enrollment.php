<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function child(){
        return $this->belongsTo(Child::class);
    }

    public function attendances(){
        return $this->hasMany(Attendance::class);
    }
    

}
