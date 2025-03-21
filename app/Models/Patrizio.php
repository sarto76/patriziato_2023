<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patrizio extends Model
{
    protected $table = 'patrizi';
    use HasFactory;

    protected $fillable = ['register_number', 'firstname', 'lastname', 'birth', 'death', 'living', 'note',
        'patriziato_lost', 'phone', 'email', 'street', 'zip', 'city', 'picture', 'password', 'confirmed'];



    public function father()
    {
        return $this->belongsTo(Patrizio::class, 'patrizio1_id', 'id')
            ->where('relations.type', 'father')
            ->withDefault();
    }

    public function mother()
    {
        return $this->belongsTo(Patrizio::class, 'patrizio1_id')->where('type', 'mother')
            ->withDefault();
    }

    public function spouse()
    {
        return $this->belongsTo(Patrizio::class, 'patrizio1_id')->where('relations.type', 'spouse')
            ->withDefault();
    }

}
