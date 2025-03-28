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





// Metodo per ottenere il padre con SQL diretto
    public function getFatherAttribute()
    {
        $result = DB::selectOne("SELECT patrizi.* FROM patrizi
                           JOIN relations ON patrizi.id = relations.patrizio1_id
                           WHERE relations.type = 'father'
                           AND relations.patrizio2_id = ?", [$this->id]);

        return $result ? Patrizio::hydrate([(array)$result])->first() : new Patrizio();
    }

    public function getMotherAttribute()
    {
        $result = DB::selectOne("SELECT patrizi.* FROM patrizi
                           JOIN relations ON patrizi.id = relations.patrizio1_id
                           WHERE relations.type = 'mother'
                           AND relations.patrizio2_id = ?", [$this->id]);

        return $result ? Patrizio::hydrate([(array)$result])->first() : new Patrizio();
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
