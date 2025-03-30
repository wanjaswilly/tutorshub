<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class HelpTickets extends Model
{
    //

    protected $fillable = [
        'helpCategory', # Technical(signup), Billing, Tutoring, Support, Others
        'subject', # summary of the issue
        'issueDescription', # lengthy description
        'attachments', # array(filenames of the attachments)
        'replies', # array(tracks the following): from, datetime, response, attachments
        'issueStatus', # Pending, In Progress, Solved, Flagged 
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'createdBy', 'id');
    }

    public function assignedTo() :BelongsTo
    {
        return $this->belongsTo(Admin::class, 'assignedTo', 'id');
    }
}
