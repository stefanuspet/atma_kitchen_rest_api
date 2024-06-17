<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    public $primaryKey = 'email';
    public $table = 'password_reset_tokens';

    public $timestamps = false;

    protected $fillable = [
        'email',
        'token',
        'is_used',
        'created_at',
    ];
}
