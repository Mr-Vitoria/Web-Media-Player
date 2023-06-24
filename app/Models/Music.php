<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    protected $primaryKry = 'id';
    protected $table = 'musics';
    protected $filable = ['year','name','text','author','duration','imagepath','musicpath'];

}
