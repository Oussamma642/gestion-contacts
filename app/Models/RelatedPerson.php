<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedPerson extends Model
{
    use HasFactory;
    protected $table = "related_persons";

    public function personB()
    {
        return $this->belongsTo(Contact::class, 'personB');
    }

    public function typeRelation()
    {
        return $this->belongsTo(TypeRelation::class, 'type_relation_id');
    }

}