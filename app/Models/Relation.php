<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    protected $table = 'relations';

    protected $fillable = [
        'patrizio1_id',
        'patrizio2_id',
        'type',
    ];


    public function patrizio1()
    {
        return $this->belongsTo(Patrizio::class, 'patrizio1_id');
    }

    public function patrizio2()
    {
        return $this->belongsTo(Patrizio::class, 'patrizio2_id');
    }


}
