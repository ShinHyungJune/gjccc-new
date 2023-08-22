<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    protected $primaryKey = "id";

    protected $fillable = ["id", "ids", "token", "password"];

    public $timestamps = false;

    public function resetUrl()
    {
        return config("app.url")."/passwordResets/$this->token/edit";
    }

    public function resetUrlPath()
    {
        return "/passwordResets/$this->token/edit";
    }
}
