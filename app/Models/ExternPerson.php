<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExternPerson extends Model
{
    protected $table = 'extern_persons';
    protected $fillable = ['fullname'];


    public function getFirstnameAttribute()
    {
        return explode(' ', $this->fullname)[0] ?? $this->fullname;
    }

    public function getLastnameAttribute()
    {
        $parts = explode(' ', $this->fullname);
        array_shift($parts); // rimuove il firstname
        return implode(' ', $parts);
    }


}
