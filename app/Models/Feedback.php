<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "dating_id",
        "how_about_dating",
        "want_after",
        "likeablility",
        "manner",
        "how_about_place",
        "comment",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dating()
    {
        return $this->belongsTo(Dating::class);
    }
}
