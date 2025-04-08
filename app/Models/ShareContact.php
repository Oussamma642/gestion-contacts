<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShareContact extends Model
{
    protected $table = 'share_contacts';

    protected $fillable = [
        'sender_id', 'receiver_id', 'contact_id', 'status',
    ];
}