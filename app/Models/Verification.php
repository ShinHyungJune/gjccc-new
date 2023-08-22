<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasFactory;

    protected $fillable = [
        "imp_uid",
        "merchant_uid",
        "name",
        "phone",
        "birth",
        "sex"
    ];
}
