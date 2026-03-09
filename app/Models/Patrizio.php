<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Patrizio extends Model
{
    protected $table = 'patrizi';
    use HasFactory;

    protected $fillable = ['register_number', 'firstname', 'lastname', 'birth', 'death', 'living', 'note',
        'patriziato_lost', 'phone', 'email', 'street', 'zip', 'city', 'picture', 'password', 'confirmed'];


    public function relationMother()
    {
        return $this->hasOne(Relation::class, 'patrizio2_id')
            ->where('type', 'mother');
    }

    public function relationFather()
    {
       return $this->hasOne(Relation::class, 'patrizio2_id')
            ->where('type', 'father');

    }



// Metodo per ottenere il padre con SQL diretto
    public function getFatherAttribute()
    {
        $relation = DB::table('relations')
            ->where('type', 'father')
            ->where('patrizio2_id', $this->id)
            ->first();

        if (!$relation) {
            return null;
        }

        if ($relation->patrizio1_id) {
            return Patrizio::find($relation->patrizio1_id);
        }

        if ($relation->extern_person_id) {
            return ExternPerson::find($relation->extern_person_id);
        }

        return null;
    }

    public function getMotherAttribute()
    {
        $relation = DB::table('relations')
            ->where('type', 'mother')
            ->where('patrizio2_id', $this->id)
            ->first();

        if (!$relation) {
            return null;
        }

        // Madre interna
        if ($relation->patrizio1_id) {
            return Patrizio::find($relation->patrizio1_id);
        }

        // Madre esterna
        if ($relation->extern_person_id) {
            return ExternPerson::find($relation->extern_person_id);
        }

        return null;
    }

    public function getSpouseAttribute()
    {
        $result = DB::selectOne("SELECT patrizi.* FROM patrizi
                           JOIN relations ON patrizi.id = relations.patrizio1_id
                           WHERE relations.type = 'spouse'
                           AND relations.patrizio2_id = ?", [$this->id]);

        return $result ? Patrizio::hydrate([(array)$result])->first() : new Patrizio();
    }

}
