<?php
namespace App\Models;

use App\Models\Category;
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function relatedPersons()
    {
        return $this->belongsToMany(
            Contact::class,  // Self-referencing
            'related_persons', // Pivot table name
            'personA',  // Foreign key for this contact
            'personB'   // Foreign key for the related contact
        )->withPivot('type_relation_id'); // Include relation type
    }
}