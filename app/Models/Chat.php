<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        "dating_id",
        "read"
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot(["has_new_message"]);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function dating()
    {
        return $this->belongsTo(Dating::class);
    }
}
