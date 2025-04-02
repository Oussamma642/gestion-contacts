<?php
namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'category',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function relatedContacts()
    {
        return $this->belongsToMany(Contact::class, 'related_persons', 'personA', 'personB')
            ->withPivot('type')
            ->withTimestamps();
    }

}
