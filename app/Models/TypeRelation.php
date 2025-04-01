<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeRelation extends Model
{
    use HasFactory;
    public function relatedPersons()
    {
        return $this->hasMany(RelatedPerson::class, 'type_relation_id');
    }

}