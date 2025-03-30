<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TutorsMessages extends Model
{
    protected $fillable = [
        'userID', # from users
        'messages', # json : from, studentTutorsID(chat in reference), date, time, message, reply, status(read/unread)
    ];
}
