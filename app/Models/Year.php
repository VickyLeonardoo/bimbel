<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

}
