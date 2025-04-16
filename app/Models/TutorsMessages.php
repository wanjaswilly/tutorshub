<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TutorsMessages extends Model
{
    protected $fillable = [
        'userID', # from users
        'messages', # json :'userID_StudentSubscribedPackeID_number': {from, to, datetime, message, replyTo(nullable), status(read/unread), attachments}
        'unreadMessages', # number of unread messages from different users
    ];
}
