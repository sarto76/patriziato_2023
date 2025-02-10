<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patrizio extends Model
{
    protected $table = 'patrizi';
    use HasFactory;
    protected $fillable = ['name','surname','email','phone','address','city','zip','province','region','country','note','active'];

}
