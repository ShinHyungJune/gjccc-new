<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $touches = ['chat'];

    protected $fillable = [
        "chat_id",
        "message_id",
        "user_id",
        "body",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}
