<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVerification extends Model
{
    use HasFactory;
    protected $table = 'user_verifications';
    protected $fillable = [
        'user_id',
        'otp',
        'validTime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}