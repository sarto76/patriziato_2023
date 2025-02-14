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

}
