<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class PasswordResetToken extends Model
{
    protected $table = 'password_reset_tokens';
    public $timestamps = false;

    protected $fillable = ['email', 'token', 'created_at'];

    public function isTokenValid()
    {
        // Define token expiration, example: 60 minutes
        return $this->created_at > Carbon::now()->subMinutes(15);
    }
}
